<?php

namespace App\Models\Invoices;

use App\Models\Invoices\Charge;
use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encounter extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'encounter';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pid',
        'entryDate',
        'serviceDate',
        'serviceDateTo',
        'facilityID',
        'billingFacilityID',
        'placeOfServiceID',
        'sensitivity',
        'admisionDate',
        'dischargeDate',
        'renderingProviderID',
        'referringProviderID',
        'orderingProviderID',
        'supervisingProviderID',
        'consult',
        'authorizationNumberID',
        'conditionOriginatedDate',
        'firstConsultedDate',
        'lastSeenDate',
        'acuteManifestationDate',
        'lastXRayDate',
        'illnessAccidentPregnancy',
        'autoAccidentState',
        'accidentDate',
        'employmentRelated',
        'mammographyCertificateNumber',
        'claimReason',
        'originalReferenceNumber',
        'delayReason',
        'claimNote',
        'codeClaimNote',
        'lineNote',
        'codeLineNote',
        'reportType',
        'reportTransmission',
        'attachmentControlNumber',
        'medicaidServicesEP',
        'referralGiven',
        'condition1',
        'condition2',
        'condition3',
        'accessionNumberLabLevel',
        'salesRepresentative',
        'locationCode',
        'locationName',
        'labUserDefined',
        'referenceLab',
        'panelName',
        'labTestType'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'pid',
        'updated_at',
        'deleted_at',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'entryDate'                 => 'datetime:M d, Y',
        'serviceDate'               => 'datetime:M d, Y',
        'serviceDateTo'             => 'datetime:M d, Y',
        'admisionDate'              => 'datetime:M d, Y',
        'dischargeDate'             => 'datetime:M d, Y',
        'conditionOriginatedDate'   => 'datetime:M d, Y',
        'firstConsultedDate'        => 'datetime:M d, Y',
        'lastSeenDate'              => 'datetime:M d, Y',
        'acuteManifestationDate'    => 'datetime:M d, Y',
        'lastXRayDate'              => 'datetime:M d, Y',
        'accidentDate'              => 'datetime:M d, Y',
        'employmentRelated'         => 'boolean',
        'medicaidServicesEP'        => 'boolean',
        'referralGiven'             => 'boolean',
    ];


    /**
     * Get patient information associated to invoice
     *
     * @return void
     */
    public function patientInfo()
    {
        return $this->belongsTo(Patient::class, 'pid', 'pid');
    }


    /**
     * Get charges information associated to encounter
     *
     * @return void
     */
    public function chargesList()
    {
        return $this->hasMany(Charge::class, 'encounter', 'encounter');
    }



    public function getTotalChargesAttribute()
    {
        return count($this->chargesList);
    }
}
