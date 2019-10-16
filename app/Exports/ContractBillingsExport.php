<?php

namespace App\Exports;

use App\ContractBilling;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContractBillingsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ContractBilling::with('user')->get();
    }
}
