<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Buyer;

class TestController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
                    ->with('product.categories')
                    ->get()->pluck('product.categories')
                    ->collapse();

         return view('welcome');

    }
}
