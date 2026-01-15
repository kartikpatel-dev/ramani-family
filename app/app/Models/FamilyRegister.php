<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\State;
use App\Models\District;
use App\Models\SubDistrict;

class FamilyRegister extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'family_register';   // ✅ IMPORTANT

    protected $fillable = [
        'name','password',
        'first_name','middle_name','surname',
        'state_id','state_name','district_id','district_name','sub_district_id','sub_district_name','village','address',
        'dob','mobile','show_number',
        'gender','marital_status','last_donated',
        'blood_group','donate_blood',

        // business
        'business_name','business_address','business_contact','other_detail',

        // marital
        'height','weight','zodiac','education','occupation',
        'brother','sister','maternal_detail','property_detail'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class);
    }
}

