<?php

namespace App\Models\Invoices;

use App\Models\Invoices\Encounter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charge extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'chargeID';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'encounter',
        'codeType',
        'code',
        'codeText',
        'fee',
        'copay',
        'units',
        'NDCvalue',
        'NDCquantity',
        'NDCtype',
        'modifier',
        'noteCodes',
        'custom1',
        'custom2',
        'custom3',
        'custom4',
        'custom5',
        'ICDitems',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'encounter',
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
        'created_at' => 'datetime:M d, Y',
    ];


    /**
     * Get encounter information associated to charge
     *
     * @return void
     */
    public function encounterInfo()
    {
        return $this->belongsTo(Encounter::class, 'encounter', 'encounter');
    }
}
