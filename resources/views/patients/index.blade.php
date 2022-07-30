@extends('layouts.dashemr')

@section('title', 'Patient\'s List')

@section('content')
<table class="table w-full">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th align="left">Name</th>
            <th>&nbsp;</th>
            <th align="center">Phone</th>
            <th>&nbsp;</th>
            <th align="center">SSN</th>
            <th>&nbsp;</th>
            <th align="center">Date of Birth</th>
            <th>&nbsp;</th>
            <th align="center">Accession #</th>
            <th>&nbsp;</th>
            <th align="center">External PID</th>
            <th>&nbsp;</th>
            <th align="center">PID</th>
            <th>&nbsp;</th>
            <th align="center">Last Srv Date</th>
            <th>&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients AS $patient)
        <tr>
            <td>&nbsp;</td>
            <td>{{ $patient->full_name }}</td>
            <td>&nbsp;</td>
            <td align="center">{{ $patient->homePhone }}</td>
            <td>&nbsp;</td>
            <td align="center">{{ $patient->socialSecurityNumber }}</td>
            <td>&nbsp;</td>
            <td align="center">{{ $patient->dateOfBirth->format('M d, Y') }}</td>
            <td>&nbsp;</td>
            <td align="center"> -- </td>
            <td>&nbsp;</td>
            <td align="center">{{ $patient->patientInfo->externalPid }}</td>
            <td>&nbsp;</td>
            <td align="center">{{ $patient->patientInfo->pid }}</td>
            <td>&nbsp;</td>
            <td align="center">{{ $patient->patientInfo->lastServiceDate() }}</td>
            <td>&nbsp;</td>
            <td align="center">
                <a class="link link-hover" title="View" href="{{ route('patients.show', ['patient' => $patient]) }}">
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
            <th>&nbsp;</th>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="18">{{ $patients->links() }}</td>
        </tr>
    </tfoot>
</table>
@endsection

@push('scripts')
@endpush
