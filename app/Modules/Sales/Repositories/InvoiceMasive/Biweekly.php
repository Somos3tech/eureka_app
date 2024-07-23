<?php

namespace App\Modules\Sales\Repositories\InvoiceMasive;

use Auth;

class Biweekly implements InvoiceMasiveServiceInterface
{
    /****************************************************************************/
    public function fields($request, $row)
    {
        $rate_amount = $row['amount'];
        $proration_posted = 0;
        $proration_reconnection = 0;
        $proration_warranty = 0;

        if ($request->type_biweekly == 1) {
            $type_biweekly = 'Primera Quincena';
        } elseif ($request->type_biweekly == 2) {
            $type_biweekly = 'Segunda Quincena';
        }

        $conceptc = serialize([
            'commerce' => $row['commerce'],
            'bank_name' => $row['bank'],
            'affiliate_number' => $row['affiliate'],
            'term_abrev' => $row['term'],
            'term_name' => $row['description'],
            'type_biweekly' => $type_biweekly,
            'terminal' => $row['terminal'],
            'order_posted' => $row['order_posted'],
            'reactive_date' => $row['reactive_date'],
            'date_ini' => $row['date_ini'],
            'date_end' => $row['date_end'],
            'currency_id' => $row['currency_id'],
            'proration_posted' => $proration_posted,
            'proration_reconnection' => $proration_reconnection,
            'proration_warranty' => $proration_warranty,
        ]);
        $data = [
            'contract_id' => $row['contract_id'],
            'bank_id' => $row['bank_id'],
            'refere' => 'Servicio Transaccional',
            'fechpro' => $row['fechpro'],
            'tipcta' => $row['type_account'],
            'concept_id' => 2,
            'customer_id' => $row['customer_id'],
            'rif' => $row['rif'],
            'business_name' => $row['business_name'],
            'nrocta' => $row['account_number'],
            'nropos' => $row['nropos'],
            'tipnot' => 'Estandar',
            'type_sale' => 'Basic',
            'currency_id' => $row['currency_id'],
            'amount' => $rate_amount,
            'amount_currency' => '1.00',
            'free' => '0.00',
            'frec_invoice' => $request['type_service'],
            'conceptc' => $conceptc,
            'status' => 'G',
            'user_created_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $data;
    }
}