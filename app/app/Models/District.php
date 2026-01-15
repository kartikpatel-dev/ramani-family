<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['state_id', 'name'];

    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class);
    }
}
