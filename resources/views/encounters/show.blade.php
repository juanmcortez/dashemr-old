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
                <td>{{ $encounter->serviceDate->format('M d, Y') }}</td>
                <td>{{ $encounter->serviceDateTo }}</td>
                <td>{{ $encounter->facilityID }}</td>
                <td>{{ $encounter->billingFacilityID }}</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="3">
                    <textarea>{{ $encounter->consult }}</textarea>
                </td>
                <td>{{ $encounter->placeOfServiceID }}</td>
                <td>{{ $encounter->sensitivity }}</td>
            </tr>
            <tr>
                <td>{{ $encounter->admisionDate }}</td>
                <td>{{ $encounter->dischargeDate }}</td>
            </tr>
            <tr>
                <td>{{ $encounter->renderingProviderID }}</td>
                <td>{{ $encounter->referringProviderID }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ $encounter->authorizationNumberID }}</td>
                <td>{{ $encounter->orderingProviderID }}</td>
                <td>{{ $encounter->supervisingProviderID }}</td>
            </tr>
        </tbody>
    </table>

    <hr />

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tbody>
            @foreach($encounter->chargesList as $charge)
            <tr>
                <td colspan="2">{{ $charge->codeType }}: {{ $charge->code }} - {{ $charge->codeText }}</td>
                <td>$ {{ $charge->fee }}</td>
                <td>$ {{ $charge->copay }}</td>
                <td>{{ $charge->units }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ $charge->modifier }}</td>
                <td colspan="3">{{ $charge->noteCodes }}</td>
            </tr>
            <tr>
                <td>{{ $charge->custom1 }}</td>
                <td>{{ $charge->custom2 }}</td>
                <td>{{ $charge->custom3 }}</td>
                <td>{{ $charge->custom4 }}</td>
                <td>{{ $charge->custom4 }}</td>
            </tr>
            <tr>
                <td colspan="5">{{ $charge->ICDitems }}</td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
