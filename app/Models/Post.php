<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover',
        'content',
    ];

    public function author() {
        return $this->belongsTo(User::class, "userId", "id");
    }
}
