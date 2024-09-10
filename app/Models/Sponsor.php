<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'duration',
        'cost'
    ];


    // Relazione con Sponsor e Apartments
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }

}
