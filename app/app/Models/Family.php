<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_name',
        'head_name',
        'phone',
        'email',
        'address',
    ];

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}

