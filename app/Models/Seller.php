<?php

namespace App\Models;
use App\Models\Product;
use App\User;
//use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
