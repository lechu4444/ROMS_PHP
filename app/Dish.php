<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    public function getPriceAttribute()
    {
        return (double) $this->attributes['price'] / 100;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int) $value * 100;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }
}
