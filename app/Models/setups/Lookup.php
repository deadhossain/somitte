<?php

namespace App\Models\setups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Lookup extends Model
{
    use HasFactory;
    protected $table = 'lookups';
    protected $fillable = [
        'name','remarks','active_fg'
    ];

    public function getIdAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function lookupDetails()
    {
        // return $this->hasMany('LookupDetail');
        return $this->hasMany(LookupDetail::class, 'lookup_id', 'id');
    }
}
