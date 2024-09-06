<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'view_date',
        'ip_address'
    ];





    // Relazione View con Apartment
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }

}
