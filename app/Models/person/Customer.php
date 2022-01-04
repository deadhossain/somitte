<?php

namespace App\Models\person;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\loan\LoanAccount;
use App\Models\loan\LoanDeposit;
use App\Models\savings\SavingsAccount;
use App\Models\savings\SavingsDeposit;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','nid_no','customer_uid','gender_id','phone','start_date','end_date','image','nid_attachment','address','remarks','active_fg'
    ];

    protected $appends = [
        'status'
    ];

    public function getEncryptIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function getImagePathAttribute()
    {
        return $this->image?asset('/storage/customers/images/'.$this->image):asset('assets/images/customer-default.png');
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['active_fg'] == 1) return '<label class="label label-success">ACTIVE</label>';
            return '<label class="label label-danger">INACTIVE</label>';
    }

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class, 'customer_id', 'id');
    }

    public function activeSavingsAccounts()
    {
        return $this->savingsAccounts()->where('active_fg',1);
    }

    public function savingsDeposits()
    {
        return $this->hasManyThrough(
            SavingsDeposit::class,
            SavingsAccount::class,
            'customer_id', // Foreign key on the SavingsAccount table...
            'savings_accounts_id', // Foreign key on the SavingsDeposit table...
            'id', // Local key on the customer table...
            'id' // Local key on the environments table...
        );
    }

    public function activeSavingsDeposits()
    {
        return $this->savingsDeposits()->where('savings_deposits.active_fg',1);
    }

    public function getTotalActiveSavingsDepositsAttribute()
    {
        return $this->activeSavingsDeposits()->sum('savings_deposits.deposit_amount');
    }

    public function getTotalActiveSavingsDepositsLateFeeAttribute()
    {
        return $this->activeSavingsDeposits()->sum('savings_deposits.late_fee');
    }

    public function loanAccounts()
    {
        return $this->hasMany(LoanAccount::class, 'customer_id', 'id');
    }

    public function activeLoanAccounts()
    {
        return $this->loanAccounts()->where('active_fg',1);
    }

    public function getTotalLoanAmountAttribute()
    {
        return $this->activeLoanAccounts()->sum('total_payable_amount')+0;
    }

    public function loanDeposits()
    {
        return $this->hasManyThrough(
            loanDeposit::class,
            loanAccount::class,
            'customer_id', // Foreign key on the LoanAccount table...
            'loan_accounts_id', // Foreign key on the LoanDeposit table...
            'id', // Local key on the customer table...
            'id' // Local key on the environments table...
        );
    }

    public function activeLoanDeposits()
    {
        return $this->loanDeposits()->where('loan_deposits.active_fg',1);
    }

    public function getTotalActiveLoanDepositsAttribute()
    {
        return $this->activeLoanDeposits()->sum('loan_deposits.deposit_amount')+0;
    }

    public function getTotalActiveLoanDepositsLateFeeAttribute()
    {
        return $this->activeLoanDeposits()->sum('loan_deposits.late_fee')+0;
    }


}
