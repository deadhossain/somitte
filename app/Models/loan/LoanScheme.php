<?php

namespace App\Models\loan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class LoanScheme extends Model
{
    use HasFactory;

    protected $table = 'loan_schemes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','min_amount','max_amount','late_fee','rate','max_installment','remarks','active_fg'
    ];

    protected $appends = [
        'status','amount_range'
    ];

    public function getEncryptIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function getMinAmountAttribute()
    {
        return $this->attributes['min_amount']+0; // remove trailing zeroes
    }

    public function getMaxAmountAttribute()
    {
        return $this->attributes['max_amount']+0; // remove trailing zeroes
    }

    public function getAmountRangeAttribute()
    {
        return $this->getMinAmountAttribute().' - '.$this->getMaxAmountAttribute(); // remove trailing zeroes
    }

    public function getRateAttribute()
    {
        return $this->attributes['rate']+0; // remove trailing zeroes
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
