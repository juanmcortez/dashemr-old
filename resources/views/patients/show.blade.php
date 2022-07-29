@extends('layouts.dashemr')

@section('title', $patient->demographic->full_name . '\'s Ledger')

@section('content')
<table class="table w-full">
    <tbody>
        <tr>
            <td rowspan="2">{{ $patient->demographic->full_name }}</td>
            <td>{{ $patient->pid }}</td>
            <td>{{ $patient->demographic->socialSecurityNumber }}</td>
            <td>{{ $patient->demographic->street }}</td>
            <td>{{ $patient->demographic->dateOfBirth->format('M d, Y') }}</td>
        </tr>
        <tr>
            <td>{{ $patient->externalPid }}</td>
            <td>{{ $patient->demographic->homePhone }}</td>
            <td>
                {{ $patient->demographic->city }} - {{ $patient->demographic->state }} {{ $patient->demographic->zip
                }}
            </td>
            <td>{{ $patient->demographic->age }}</td>
        </tr>
    </tbody>
</table>

<hr />

<table class="table w-full">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>DOS</th>
            <th>Code Type</th>
            <th>Code</th>
            <th>Prov</th>
            <th>Units</th>
            <th>Fee</th>
            <th>Payment</th>
            <th>Adjustment</th>
            <th>PTP</th>
            <th>Balance</th>
            <th>DOE</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($patient->invoiceList as $invoice)
        @foreach ($invoice->chargesList as $charge)
        <tr>
            @if ($loop->first)
            <td valign="top" rowspan="{{ $invoice->total_charges }}">{{ $invoice->encounter }}</td>
            <td valign="top" rowspan="{{ $invoice->total_charges }}">
                {{ $invoice->serviceDate->format('M d, Y') }}
            </td>
            @endif
            <td>{{ $charge->codeType }}</td>
            <td>{{ $charge->code }}</td>
            @if ($loop->first)
            <td valign="top" rowspan="{{ $invoice->total_charges }}">{{ $invoice->referringProviderID }}</td>
            @endif
            <td>{{ $charge->units }}</td>
            <td>$ {{ $charge->fee }}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            @if ($loop->first)
            <td valign="top" rowspan="{{ $invoice->total_charges }}">
                {{ $invoice->entryDate->format('M d, Y') }}
            </td>
            <td>
                <a class="link link-hover" title="View"
                    href="{{ route('encounter.show', ['patient' => $patient->pid, 'encounter' => $invoice->encounter]) }}">
                    <svg class="w-4 h-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </a>
            </td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td colspan="12">&nbsp;</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
@endpush
