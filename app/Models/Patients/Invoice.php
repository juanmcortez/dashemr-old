<?php

namespace App\Models\Patients;

use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
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
        'entryDate'    => 'datetime:M d, Y',
        'serviceDate'  => 'datetime:M d, Y'
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
}
