<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'name',
        'title',
        'slug',
        'description',
        'image',
        'price',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'float',
    ];

    /**
     * Relationship: Created By (User/Admin)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by'); 
    }

    /**
     * Accessor: Full image URL (optional)
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('uploads/services/' . $this->image) : asset('images/default-service.png');
    }
}
