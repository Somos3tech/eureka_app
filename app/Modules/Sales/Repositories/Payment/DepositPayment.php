<?php

namespace App\Modules\Sales\Repositories\Payment;

class DepositPayment implements PayableInterface
{
    public function pay($request)
    {
        return ['contract_id' => $request['contract_id'], 'tipnot' => 'Deposito', 'concept_id' => 1, 'refere' => $request['refere'], 'currency_id' => $request['currency_id'], 'amount' => str_replace(',', '', $request['amount']), 'amount_currency' => str_replace(',', '', $request['dicom']), 'conceptc' => 'VENTA EQUIPO', 'status' => 'G'];
    }
}