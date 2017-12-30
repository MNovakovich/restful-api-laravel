<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Buyer;

class BuyerSellerController extends ApiController
{
    
    public function index($id)
    {
        $sellers = Buyer::find($id)->transactions()->with('product.seller')->get()->pluck('product.seller');

        return $this->showAll($sellers);
    }

    
}
