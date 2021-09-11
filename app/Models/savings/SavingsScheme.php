<?php

namespace App\Models\savings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class SavingsScheme extends Model
{
    use HasFactory;

    protected $table = 'savings_schemes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','amount','late_fee','profit','start_date','end_date','remarks','active_fg','remarks'
    ];

    protected $appends = [
        'status'
    ];

    public function getIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function getAmountAttribute()
    {
        return $this->attributes['amount']+0; // remove trailing zeroes
    }

    public function getProfitAttribute()
    {
        return $this->attributes['profit']+0; // remove trailing zeroes
    }

    public function getLateFeeAttribute()
    {
        return $this->attributes['late_fee']+0; // remove trailing zeroes
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['active_fg'] == 1) return '<label class="label label-success">ACTIVE</label>';
            return '<label class="label label-danger">INACTIVE</label>';
    }
}
