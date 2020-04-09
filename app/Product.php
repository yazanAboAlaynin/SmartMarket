<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded =[];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function order_items(){
        return $this->hasMany(Order_item::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
