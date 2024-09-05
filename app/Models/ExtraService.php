<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'apartment_id',
        'extra_service_id'
    ];



    public function Apartment()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
