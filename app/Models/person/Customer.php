<?php

namespace App\Models\person;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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
        'name','nid_no','gender_id','phone','start_date','end_date','image','nid_attachment','address','remarks','active_fg'
    ];

    protected $appends = [
        'status'
    ];

    public function getIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['active_fg'] == 1) return '<label class="label label-success">ACTIVE</label>';
            return '<label class="label label-danger">INACTIVE</label>';
    }
}
