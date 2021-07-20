<?php

namespace App\Models\setups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    use HasFactory;
    protected $table = 'lookups';
    protected $fillable = [
        'name','remarks','active_fg'
    ];

    public function lookupDetails()
    {
        // return $this->hasMany('LookupDetails');
        return $this->hasMany(LookupDetails::class, 'lookup_id', 'id');
    }
}
