<?php

namespace App\Models\savings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class SavingsDeposit extends Model
{
    use HasFactory;

    protected $table = 'savings_deposits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'savings_accounts_id','deposit_amount','late_fee','schedule_date','deposit_date','active_fg','remarks'
    ];

    protected $appends = [
        'status'
    ];

    public function getEncryptIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function savingsAccount()
    {
        return $this->belongsTo(SavingsAccount::class, 'savings_accounts_id', 'id');
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['active_fg'] == 1) return '<label class="label label-success">ACTIVE</label>';
            return '<label class="label label-danger">INACTIVE</label>';
    }
}
