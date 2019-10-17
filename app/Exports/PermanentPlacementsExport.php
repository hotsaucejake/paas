<?php

namespace App\Exports;

use App\PermanentPlacement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PermanentPlacementsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PermanentPlacement::with('user')->get();
    }


    public function map($permanentPlacement): array
    {
        return [
            $permanentPlacement->id,
            $permanentPlacement->user->name,
            $permanentPlacement->customer_name,
            $permanentPlacement->ap_contact,
            $permanentPlacement->ap_email,
            $permanentPlacement->ap_phone,
            $permanentPlacement->customer_po,
            $permanentPlacement->customer_status,
            $permanentPlacement->bill_address,
            $permanentPlacement->placement_name,
            $permanentPlacement->placement_email,
            $permanentPlacement->placement_phone,
            $permanentPlacement->position,
            $permanentPlacement->salary,
            $permanentPlacement->perm_fee,
            $permanentPlacement->total_fee,
            $permanentPlacement->start_date,
            $permanentPlacement->recruiter,
            $permanentPlacement->sales_rep,
            $permanentPlacement->special_notes,
            $permanentPlacement->approved,
            $permanentPlacement->created_at,
            $permanentPlacement->updated_at,
        ];
    }


    public function headings(): array
    {
        return [
            'id',
            'user',
            'customer_name',
            'ap_contact',
            'ap_email',
            'ap_phone',
            'customer_po',
            'customer_status',
            'bill_address',
            'placement_name',
            'placement_email',
            'placement_phone',
            'position',
            'salary',
            'perm_fee',
            'total_fee',
            'start_date',
            'recruiter',
            'sales_rep',
            'special_notes',
            'approved',
            'created_at',
            'updated_at',
        ];
    }
}
