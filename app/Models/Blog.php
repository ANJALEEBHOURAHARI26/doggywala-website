<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Table name (optional if it's 'blogs')
    protected $table = 'blogs';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
    ];

    // Relationship: A blog belongs to a user (admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
