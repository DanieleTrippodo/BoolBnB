<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    use HasFactory;

    protected $table = 'extra_services';

    protected $fillable = [
        'id',
        'name',
        'is_available',
    ];



    public function Apartment()
    {
        return $this->belongsToMany(Apartment::class);
    }
}