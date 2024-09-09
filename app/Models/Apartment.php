<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'rooms_num',
        'beds_num',
        'bathroom_num',
        'sq_mt',
        'address',
        'latitude',
        'longitude',
        'images',
        'visibility'
    ];



    public function User()
    {
        return $this->belongsTo(User::class);
    }


    public function Sponsor()
    {
        return $this->belongsToMany(Sponsor::class);
    }


    public function extraServices()
    {
        return $this->belongsToMany(ExtraService::class, 'apartment_service');
    }


}