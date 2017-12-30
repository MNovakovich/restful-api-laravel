<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Category;

class CategoryBuyerController extends ApiController
{
    
    public function index(Category $category)
    {
        $buyers =  $category->products()
             ->whereHas('transactions')
             ->with('transactions.buyer')
             ->get()
             ->pluck('transactions')
             ->collapse('buyer')
             ->pluck('buyer')
             ->unique('id')
             ->values();

        return $this->showAll($buyers);

    }

    
}
