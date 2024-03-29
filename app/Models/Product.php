<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName',
        'categoryId',
        'price',
        'quantity',
        'image'
    ];

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
