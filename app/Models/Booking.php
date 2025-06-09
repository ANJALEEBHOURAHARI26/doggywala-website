<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'service',
        'appointment_date',
        'appointment_time',
        'message',
    ];

   public function serviceDetail()
    {
        return $this->belongsTo(Service::class, 'service');
    }
}
