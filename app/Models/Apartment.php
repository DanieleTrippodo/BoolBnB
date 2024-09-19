<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;


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


    public function sponsors()
{
    return $this->belongsToMany(Sponsor::class, 'apartment_sponsor')
                ->withPivot('start_date', 'end_date');
}


    public function extraServices()
    {
        return $this->belongsToMany(ExtraService::class, 'apartment_service');
    }

    public function messages()
{
    return $this->hasMany(Message::class);
}

}
