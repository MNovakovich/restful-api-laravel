<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Seller;
class SellerBuyerController extends ApiController
{
    
    public function index(Seller $seller)
    {
        $buyers = $seller->products()
                ->whereHas('transactions')
                ->with('transactions.buyer')
                ->get()
                ->pluck('transactions')
                ->collapse()
                ->pluck('buyer')
                ->unique('id')
                ->values();
                //->where('name','like','J%');

        return $this->showAll($buyers);

    }


}
