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

    public function purchase() {
        return $this->hasMany(Purchase::class);
    }

//    public function isLike($id) {
//        return $this->likes()->where('product_id',$id)->exists();
//    }
//
//    public function like($id) {
//        if($this->isLike($product_id)) {
//
//        } else {
//            $this->likes()->attach($product_id);
//        }
//    }
}
