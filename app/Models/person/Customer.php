<?php

namespace App\Models\person;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\loan\LoanAccount;
use App\Models\savings\SavingsAccount;

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

    public function loanAccounts()
    {
        return $this->hasMany(LoanAccount::class, 'customer_id', 'id');
    }

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class, 'customer_id', 'id');
    }


}
