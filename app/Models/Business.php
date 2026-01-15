<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_id',
        'business_name',
        'type',
        'gst_number',
        'phone',
        'email',
        'address',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
