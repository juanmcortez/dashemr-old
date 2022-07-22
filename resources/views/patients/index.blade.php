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
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th align="left">Name</th>
                <th>&nbsp;</th>
                <th align="center">Age</th>
                <th>&nbsp;</th>
                <th align="center">Phone</th>
                <th>&nbsp;</th>
                <th align="center">S.S.N.</th>
                <th>&nbsp;</th>
                <th align="center">PID</th>
                <th>&nbsp;</th>
                <th align="center">External PID</th>
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
                <td align="center">{{ $patient->age }}</td>
                <td>&nbsp;</td>
                <td align="center">{{ $patient->homePhone }}</td>
                <td>&nbsp;</td>
                <td align="center">{{ $patient->socialSecurityNumber }}</td>
                <td>&nbsp;</td>
                <td align="center">{{ $patient->patientInfo->pid }}</td>
                <td>&nbsp;</td>
                <td align="center">{{ $patient->patientInfo->externalPid }}</td>
                <td>&nbsp;</td>
                <th align="center">
                    <a href="{{ route('patients.show', ['patient' => $patient->patientInfo->pid]) }}">View</a>
                </th>
                <th>&nbsp;</th>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="15">{{ $patients->links() }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
