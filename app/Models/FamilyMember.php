<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'family_register_id',
        'first_name',
        'surname',
        'relation',
        'gender',
        'mobile',
        'blood_group',
        'notes',
    ];
}
