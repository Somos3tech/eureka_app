<?php

namespace App\Modules\Sales\Repositories\Payment;

class ParcialPayment implements PayableInterface
{
    public function pay($request)
    {
        switch ($request['concept_id']) {
            case '3':
                $data = [
                    'contract_id' => $request['contract_id'], 'refere' => $request['refere'], 'concept_id' => 1, 'tipnot' => 'Parcial', 'quota' => 2, 'type_sale' => $request['type_sale'], 'currency_id' => $request['currency_id'], 'free' => 0.00,
                    'amount' => str_replace(',', '', ($request['collect_partial'] + $request['inv_pending'])), 'amount_currency' => str_replace(',', '', $request['amount_currency']), 'conceptc' => 'ND VENTA TERMINAL - Parcial', 'status' => 'G',
                ];

                return $data;
                break;
            default:
                throw new \Exception('Concepto No Válido para este Método de Pago', 1);
                break;
        }
    }
}
