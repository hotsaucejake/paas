@component('mail::message')
# Contract Billing Form #{{ $billing->id }}

{{ $message }}

@component('mail::button', ['url' => route('contract_billing.show', ['contract_billing' => $billing->id]), 'color' => 'primary'])
View the Contract Billing Form
@endcomponent

## Form #{{ $billing->id }} created by {{ $billing->user->name }} on {{ $billing->created_at->toDateString() }}

**Converge Company:** {{ optional($billing->convergeCompany)->title }}

@component('mail::panel')
Candidate Info
@endcomponent

**Name:** {{ $billing->first_name }} {{ $billing->mi }} {{ $billing->last_name }}

**Consultant Company name:** {{ $billing->consultant_company }}

**Address:**

{!! nl2br($billing->address) !!}

**Phone:**  {{ $billing->phone }}

**Email:** {{ $billing->email }}

@component('mail::panel')
Position Details
@endcomponent

**Company/Client Name:** {{ $billing->client_name }}

**Job Title:** {{ $billing->job_title }}

**Job Location Address:**

{!! nl2br($billing->job_location) !!}

**Contract Rate:** {{ $billing->contract_rate }}

**Bill Rate:** {{ $billing->bill_rate }}

**Overtime Eligible:** {{ $billing->overtime_eligible ? 'Yes' : 'No' }}

**Base Salary:** {{ $billing->base_salary }}

**Start Date:** {{ $billing->start_date }}

**Contract Length:** {{ $billing->contract_period }}

**Environment:** {{ ucwords($billing->environment) }}

**Hire Type:** {{ ucwords($billing->hire_type) }}

**Project Type:** {{ $billing->project_type == 'aug' ? 'Staff Augmentation' : ($billing->project_type == 'sow' ? 'SOW' : ($billing->project_type == 'pse' ? 'Professional Services Engagement' : '')) }}

@if ($billing->sow)
**SOW:** {{ $billing->sow }}
@endif

**Issued Hardware:** {{ $billing->issued_hardware }}

**We Provide Email?** {{ $billing->corus_email ? 'Yes' : 'No' }}

**Background Check:** {{ ucwords($billing->background_check) }}

**Traveling, expense reporting?** {{ $billing->travel_reporting ? 'Yes' : 'No' }}

**Issued Concur?** {{ $billing->concur ? 'Yes' : 'No' }}

**Drug Test?**
@if($billing->drug_test == 'no')
    No
@elseif($billing->drug_test == 'p5')
    Panel 5
@elseif($billing->drug_test == 'p9')
    Panel 9
@elseif($billing->drug_test == 'p10')
    Panel 10
@elseif($billing->drug_test == 'p11')
    Panel 11
@elseif($billing->drug_test == 'other')
    Other
@endif

**Benefits?** {{ $billing->benefits ? 'Yes' : 'No' }}

@component('mail::panel')
Details
@endcomponent

**Client Contact:** {{ $billing->client_contact }}

**Hiring Manager / Timesheet Approver:** {{ $billing->manager }}

**Hiring Manager / Timesheet Approver Email:** {{ $billing->manager_email }}

**Hiring Manager / Timesheet Approver Phone:** {{ $billing->manager_phone }}

**Paycom ID:** {{ $billing->paycom_id }}

**Recruiter(s):** {{ $billing->recruiter }}

**Account Manager:** {{ $billing->account_manager }}

**Notes per AM or Client Request:**

{!! nl2br($billing->notes) !!}

@component('mail::subcopy')
If you’re having trouble clicking the "View the Contract Billing Form" button, copy and paste the URL below into your web browser:

{{ route('contract_billing.show', ['contract_billing' => $billing->id]) }}

@endcomponent
@endcomponent
