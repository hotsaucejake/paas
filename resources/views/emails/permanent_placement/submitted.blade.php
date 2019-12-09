@component('mail::message')
# Permanent Placement Form #{{ $placement->id }}

{{ $message }}

@component('mail::button', ['url' => route('permanent_placement.show', ['permanent_placement' => $placement->id]), 'color' => 'primary'])
View the Permanent Placement Form
@endcomponent

## Form #{{ $placement->id }} created by {{ $placement->user->name }} on {{ $placement->created_at->toDateString() }}

**Converge Company:** {{ optional($placement->convergeCompany)->title }}

@component('mail::panel')
Customer Info
@endcomponent

**Customer Name:** {{ $placement->customer_name }}

**AP Contact:** {{ $placement->ap_contact }}

**AP Email:** {{ $placement->ap_email }}

**AP Phone:** {{ $placement->ap_phone }}

**Customer PO#:** {{ $placement->customer_po }}

**Customer Status:** {{ ucwords($placement->customer_status) }}

**Bill to Address:**

{!! nl2br($placement->bill_address) !!}


@component('mail::panel')
Placement Info
@endcomponent

**Placement Name:** {{ $placement->placement_name }}

**Placement Phone:** {{ $placement->placement_phone }}

**Placement Email:** {{ $placement->placement_email }}

**Position:** {{ $placement->position }}

**Salary:** {{ $placement->salary }}

**Additional Cost:** {{ $placement->additional_cost }}

**Perm Fee Percentage:** {{ $placement->perm_fee }}

**Total Fee:** {{ $placement->total_fee }}

**Start Date:** {{ $placement->start_date }}

**Recruiter:** {{ $placement->recruiter }}

**Sales Rep:** {{ $placement->sales_rep }}

**Special Notes:**

{!! nl2br($placement->special_notes) !!}

@component('mail::subcopy')
If you’re having trouble clicking the "View the Permanent Placement Form" button, copy and paste the URL below into your web browser:

{{ route('permanent_placement.show', ['permanent_placement' => $placement->id]) }}

@endcomponent

@endcomponent
