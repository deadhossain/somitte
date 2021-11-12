<?php

namespace App\Models\savings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class SavingsAccount extends Model
{
    use HasFactory;

    protected $table = 'savings_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_no','first_deposit_amount','customer_id','savings_scheme_id','start_date','end_date','active_fg','remarks'
    ];

    protected $appends = [
        'status'
    ];

    public function getEncryptIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function customer()
    {
        return $this->belongsTo('App\models\person\Customer', 'customer_id', 'id');
    }

    public function activeCustomer()
    {
        return $this->customer()->where('active_fg',1);
    }

    public function savingsScheme()
    {
        return $this->belongsTo(SavingsScheme::class, 'savings_scheme_id', 'id');
    }

    public function activeSavingsScheme()
    {
        return $this->savingsScheme()->where('active_fg',1);
    }

    public function savingsDeposits()
    {
        return $this->hasMany(SavingsDeposit::class, 'savings_accounts_id', 'id');
    }

    public function activeSavingsDeposits()
    {
        return $this->savingsDeposits()->where('active_fg',1);
    }

    // current month deposit
    public function currentSavingsDeposit()
    {
        return $this->hasOne(SavingsDeposit::class, 'savings_accounts_id', 'id')->where('active_fg',1);
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['active_fg'] == 1) return '<label class="label label-success">ACTIVE</label>';
            return '<label class="label label-danger">INACTIVE</label>';
    }
}
