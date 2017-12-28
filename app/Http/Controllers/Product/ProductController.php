<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\ApiController;

use App\Models\Product;


class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return $this->showAll($products);
    }

   
    public function store(Request $request)
    {
        
    }

   
    public function show($id)
    {
        $product = Product::findOrFail($id);

         return $this->showOne($product);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
