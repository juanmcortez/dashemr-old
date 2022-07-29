@extends('layouts.dashemr')

@section('title', 'Encounter #' . $encounter->encounter . ' details')

@section('content')
<table class="table w-full">
    <tbody>
        <tr>
            <td>{{ $encounter->serviceDate->format('M d, Y') }}</td>
            <td>{{ $encounter->serviceDateTo }}</td>
            <td>{{ $encounter->facilityID }}</td>
            <td>{{ $encounter->billingFacilityID }}</td>
        </tr>
        <tr>
            <td colspan="2" rowspan="3">
                <textarea class="textarea" placeholder="Consultation">{{ $encounter->consult }}</textarea>
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

<table class="table w-full">
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
        @if($charge->codeType == 'HCPCS')
        <tr>
            <td colspan="3">{{ $charge->NDCvalue }}</td>
            <td>{{ $charge->NDCquantity }}</td>
            <td>{{ $charge->NDCtype }}</td>
        </tr>
        @elseif($charge->codeType == 'ANES' || $charge->codeType == 'CVX')
        <tr>
            <td>{{ $charge->anesthesiaStartTime }}</td>
            <td>{{ $charge->anesthesiaStopTime }}</td>
            <td>{{ $charge->anesthesiaLapseTime }}</td>
            <td>{{ $charge->anesthesiaTimeUnits }}</td>
            <td>{{ $charge->anesthesiaBaseUnits }}</td>
        </tr>
        <tr>
            <td>{{ $charge->anesthesiaUnitCharge }}</td>
            <td>{{ $charge->anesthesiaM1 }}</td>
            <td>{{ $charge->anesthesiaM2 }}</td>
            <td>{{ $charge->anesthesiaInfusion }}</td>
            <td>{{ $charge->anesthesiaBasicValue }}</td>
        </tr>
        <tr>
            <td colspan="5">{{ $charge->anesthesiaModifierUnits }}</td>
        </tr>
        @endif
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
@endsection

@push('scripts')
@endpush
