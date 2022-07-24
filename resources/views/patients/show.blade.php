<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>

<body class="antialiased">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
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

    <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
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
                    <a
                        href="{{ route('encounter.show', ['patient' => $patient->pid, 'encounter' => $invoice->encounter]) }}">
                        View
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
</body>

</html>
