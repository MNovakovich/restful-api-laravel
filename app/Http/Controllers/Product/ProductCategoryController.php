<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Product;
use App\Models\Category;

class ProductCategoryController extends ApiController
{
    public function index(Product $product)
    {
        $categories = $product->categories;

        return response()->json(['data'=>$categories, 'code'=>200],200);
    }

    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

  
    public function update(Request $request, Product $product, Category $category)
    {
        // attach and sync se koriste za viserelacione tabele
        $product->categories()->sync([$category->id]);


        return $this->showAll($product->categories);
    }


    public function destroy(Product $product, Category $category)
    {
        if($product->categories()->find($category->id))
        {
            throw new Exception("The specified category is not a category of product", 404);
            
        }
        $product->categories()->detach($category->id);

        return $this->showAll($product->categories);
    }
}
