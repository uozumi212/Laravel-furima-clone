<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'user_id'
];

    public function user() {
        return $this->belongsTo(User::class);
    }

//    public function favorites() {
//        return $this->belongsToMany(User::class, 'favorites', 'favoritable_id', 'user_id');
//    }
    public function favorites() {
        return $this->hasMany(Favorite::class, 'favoritable_id');
    }
}
