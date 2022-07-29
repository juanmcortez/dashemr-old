<?php

namespace App\Models\Patients;

use Illuminate\Support\Str;
use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demographic extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pid';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pid',
        'title',
        'firstName',
        'middleName',
        'lastName',
        'dateOfBirth',
        'genre',
        'socialSecurityNumber',
        'driverLicenseNumber',
        'street',
        'streetExtended',
        'city',
        'state',
        'zip',
        'country',
        'homePhone',
        'cellPhone',
        'emailAddress',
        'civilStatus',
        'language',
        'ethnicity',
        'race',
        'dateDeceased',
        'reasonDeceased',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'pid',
        'patientInfo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dateOfBirth' => 'datetime:M d, Y',
        'dateDeceased' => 'datetime:M d, Y',
    ];


    /**
     * Accesor: Dynamic attribute.
     *
     * @var array
     */
    protected $appends = ['age'];


    /**
     * Accesor: Genre.
     *
     * @param  string  $value
     * @return string
     */
    public function getGenreAttribute($value)
    {
        return ucfirst($value);
    }


    /**
     * Accesor: Age.
     * Dynamically added.
     *
     * @return integer
     */
    public function getAgeAttribute()
    {
        return date_diff(now(), $this->dateOfBirth)->y;
    }


    /**
     * Accesor: Full Name.
     * Dynamically created.
     *
     * @return integer
     */
    public function getFullNameAttribute()
    {
        if ($this->middleName) {
            return Str::ucfirst(Str::lower($this->lastName)) . ', ' . Str::ucfirst(Str::lower($this->firstName)) . ' ' . Str::ucfirst(Str::lower($this->middleName));
        } else {
            return Str::ucfirst(Str::lower($this->lastName)) . ', ' . Str::ucfirst(Str::lower($this->firstName));
        }
    }


    /**
     * Get patient information associated to demographic
     *
     * @return void
     */
    public function patientInfo()
    {
        return $this->belongsTo(Patient::class, 'pid', 'pid');
    }
}
