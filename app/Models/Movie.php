<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $casts = [
        'genres' => 'array'
    ];

    protected $fillable = [
        'name',
        'genres',
        'link_trailer',
        'release_year',
        'user_id',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
