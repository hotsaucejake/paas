<?php

namespace App\Exports;

use App\ContractBilling;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContractBillingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ContractBilling::with('user')->get();
    }

    public function map($contractBilling): array
    {
        return [
            $contractBilling->id,
            $contractBilling->user->name,
            $contractBilling->first_name,
            $contractBilling->mi,
            $contractBilling->last_name,
            $contractBilling->consultant_company,
            $contractBilling->phone,
            $contractBilling->email,
            $contractBilling->address,
            $contractBilling->client_name,
            $contractBilling->job_title,
            $contractBilling->job_location,
            $contractBilling->environment,
            $contractBilling->hire_type,
            $contractBilling->contract_rate,
            $contractBilling->bill_rate,
            $contractBilling->base_salary,
            $contractBilling->overtime_eligible,
            $contractBilling->project_type,
            $contractBilling->sow,
            $contractBilling->issued_hardware,
            $contractBilling->corus_email,
            $contractBilling->background_check,
            $contractBilling->travel_reporting,
            $contractBilling->start_date,
            $contractBilling->contract_period,
            $contractBilling->drug_test,
            $contractBilling->benefits,
            $contractBilling->client_contact,
            $contractBilling->manager,
            $contractBilling->manager_email,
            $contractBilling->manager_phone,
            $contractBilling->recruiter,
            $contractBilling->account_manager,
            $contractBilling->notes,
            $contractBilling->approved,
            $contractBilling->created_at,
            $contractBilling->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'user',
            'first_name',
            'mi',
            'last_name',
            'consultant_company',
            'phone',
            'email',
            'address',
            'client_name',
            'job_title',
            'job_location',
            'environment',
            'hire_type',
            'contract_rate',
            'bill_rate',
            'base_salary',
            'overtime_eligible',
            'project_type',
            'sow',
            'issued_hardware',
            'corus_email',
            'background_check',
            'travel_reporting',
            'start_date',
            'contract_period',
            'drug_test',
            'benefits',
            'client_contact',
            'manager',
            'manager_email',
            'manager_phone',
            'recruiter',
            'account_manager',
            'notes',
            'approved',
            'created_at',
            'updated_at',
        ];
    }
}
