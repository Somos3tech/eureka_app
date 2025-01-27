<?php

namespace App\Modules\Sales\Repositories\Affiliate;

use App\Modules\Parameters\Models\Payer;
use App\Modules\Sales\Models\Aconsecutive;
use App\Traits\TaskTrait;
use Auth;

class BancrecerAffiliate implements AffiliateInterface
{
    use TaskTrait;

    protected $payer;

    public function register($array, $request)
    {
        $data = [];
        $cont = 0;

        $payer = Payer::where('payers.bank_id', $request['bank_id'])->where('payers.type_file', 'LIKE', 'affiliate')->first();

        if (isset($payer)) {
            $payer_consecutive = (int) $payer->consecutive;
        } else {
            $payer_consecutive = null;
        }

        foreach ($array as $key => $row) {
            $data[$key]['code_company'] = '0010';

            $data[$key]['bank_code'] = str_pad((int) $row['bank_code'], 4, '0', STR_PAD_LEFT);

            if ($payer_consecutive != null) {
                $aconsecutive = Aconsecutive::where('aconsecutives.contract_id', (int) $row['contract_id'])->where('aconsecutives.fechpro', 'LIKE', date_format(now(), 'Y-m-d'))->whereNull('aconsecutives.is_management')->first();

                if (isset($aconsecutive)) {
                    $data[$key]['refere'] = str_pad((int) $aconsecutive['refere'], 15, '0', STR_PAD_LEFT);
                } else {
                    $payer_consecutive++;
                    $consec = Aconsecutive::create([
                        'bank_id' => $request['bank_id'],
                        'fechpro' => date_format(now(), 'Y-m-d'),
                        'contract_id' => (int) $row['contract_id'],
                        'is_management' => 1,
                        'refere' => $payer_consecutive,
                        'user_created_id' => Auth::user()->id,
                    ]);
                    if (isset($consec)) {
                        $data[$key]['refere'] = str_pad((int) $consec['refere'], 15, '0', STR_PAD_LEFT);
                    } else {
                        $data[$key]['refere'] = str_pad((int) $row['refere'], 15, '0', STR_PAD_LEFT);
                    }
                }
            } else {
                $data[$key]['refere'] = str_pad((int) $row['refere'], 15, '0', STR_PAD_LEFT);
            }

            if ($row['status_contract'] == 'Activo') {
                $data[$key]['type_operation'] = 'A';
            } elseif ($row['status_contract'] == 'Suspendido' || $row['status_contract'] == 'Cancelado') {
                $data[$key]['type_operation'] = 'D';
            }

            $rif = explode('-', $row['rif']);

            if (($rif[0] == 'V' || $rif[0] == 'P' || $rif[0] == 'E') && $row['personal_signature'] != 1) {
                $data[$key]['type_ident'] = 'N';
                $data[$key]['rif'] = str_pad(((int) $rif[1]), 11, ' ', STR_PAD_RIGHT);
            } elseif ($rif[0] == 'V' && $row['personal_signature'] == 1) {
                $data[$key]['type_ident'] = 'N';
                $data[$key]['rif'] = str_pad(((int) $rif[1]).$rif[2], 11, ' ', STR_PAD_RIGHT);
            } else {
                $data[$key]['type_ident'] = 'J';
                $data[$key]['rif'] = str_pad(((int) $rif[1]).$rif[2], 11, ' ', STR_PAD_RIGHT);
            }

            $data[$key]['letter_rif'] = $rif[0] != 'R' ? $rif[0] : 'V';

            $data[$key]['business_name'] = substr((str_replace(['ñ', 'Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', '@'], ['n', 'N', 'A', 'E', 'I', 'O', 'U', 'A'], str_replace(['+', '´'], ' ', str_replace(['&'], ' Y ', str_replace(['\'', '"', '-', '+'], '', preg_replace('/[,|.]/', ' ', preg_replace("[\n|\r|\n\r]", '', $row['business_name']))))))), 0, 30);
            $data[$key]['number_account'] = str_pad(str_replace('-', '', $row['account_number']), 20, '0', STR_PAD_LEFT);
            $data[$key]['contract_id'] = str_pad($row['contract_id'], 30, '0', STR_PAD_LEFT);

            $cont++;
        }

        if ($payer_consecutive != null) {
            $payer->consecutive = $payer_consecutive;
            $payer->save();
        }

        $document = '/afiliacion/0168/bank/AF_0010_'.date_format(now(), 'dmy_His').'.TXT';

        $file = fopen(storage_path().$document, 'w'); // Abrir

        foreach ($data as $key => $final) {
            if ($key < (count($data) - 1)) {
                fwrite($file, $final['code_company'].$final['refere'].$final['bank_code'].$final['type_operation'].$final['type_ident'].
                    $final['letter_rif'].$final['rif'].$final['number_account'].$this->str_pad_unicode($final['business_name'], 30, ' ', STR_PAD_RIGHT).$final['contract_id'].PHP_EOL);
            } else {
                fwrite($file, $final['code_company'].$final['refere'].$final['bank_code'].$final['type_operation'].$final['type_ident'].
                    $final['letter_rif'].$final['rif'].$final['number_account'].$this->str_pad_unicode($final['business_name'], 30, ' ', STR_PAD_RIGHT).$final['contract_id']);
            }
        }

        fclose($file);

        return ['filename' => $document, 'total_register' => $cont];
    }
}
