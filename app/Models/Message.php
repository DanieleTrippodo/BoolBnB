<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',   // Foreign key associata a un appartamento
        'name',           // Nome del mittente
        'sender_email',   // Email del mittente
        'message',        // Testo del messaggio
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
