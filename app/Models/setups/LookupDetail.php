<?php

namespace App\Models\setups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookupDetail extends Model
{
    use HasFactory;
    protected $table = 'lookup_details';
    protected $fillable = [
        'name','remarks','value','active_fg','lookup_id'
    ];

    public function lookup()
    {
        return $this->belongsTo(Lookup::class, 'id', 'lookup_id');
    }
}
