<?php

namespace App\Models\Patients;

use App\Models\Patients\Invoice;
use App\Models\Patients\Demographic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
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
        'externalPid'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
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
     * Get demographic information associated to patient
     *
     * @return void
     */
    public function demographic()
    {
        return $this->hasOne(Demographic::class, 'pid', 'pid');
    }


    /**
     * Get invoices information associated to patient
     *
     * @return void
     */
    public function invoiceList()
    {
        return $this->hasMany(Invoice::class, 'pid', 'pid')->orderBy('encounter', 'desc');
    }


    /**
     * Get invoices information associated to patient
     *
     * @return date
     */
    public function lastServiceDate()
    {
        return Invoice::where('pid', $this->pid)
            ->orderBy('serviceDate', 'desc')
            ->first()
            ->serviceDate
            ->format('M d, Y');
    }
}
