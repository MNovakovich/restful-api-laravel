<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
//use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\SellerProductRequest;

use App\Models\Product;
use App\Models\Seller;
use App\User;

class SellerProductController extends ApiController
{
    
    public function index(Seller $seller)
    {
        $products = $seller->products;

        return $this->showAll($products);
    }

   
    public function store(Request $request , User $seller, Product $product)
    {
       $rules = [
         'name' => 'required',
         'description' => 'required',
         'quantity' => 'required|ingeter|min:1',
         //'image' => 'required',
 
       ];

      
       $product =  new Product;
   
       $product->name = $request->input('name');
       $product->description = $request->input('description');
       $product->image =  $request->image->store();
       $product->quantity = $request->input('quantity');
       $product->status = Product::UNAVAILABLE_PRODUCT;
       $product->seller_id = $seller->id;
       $product->save();
       $this->validate($request, $rules);
       
/*
       $this->validate($request, $rules);
       $data= $request->all();

       $data['status'] = Product::UNAVAILABLE_PRODUCT;
       $data['image'] = '8.jpg';
       $data['seller_id'] = $seller->id;

       $product = Product::create($data);
*/
       return $this->showOne($product);

    }

  
    public function show($id)
    {
        
    }

  
    public function update(Request $request, Seller $seller, Product $product)
    {
        $product = Product::find($product->id);

         $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->image = 'slika.jpg';
        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->status = Product::UNAVAILABLE_PRODUCT;
        $product->seller_id = $seller->id;
       

        // $this->validate($products, $rules);

        $this->checkSeller($seller, $product);

        if($request->has('status'))
        {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0 ) {
                   throw new Exception("An active product must have at last one category", 409);
                   
            }
        }

        if($request->hasFile('image')){
            Storage::delete($product->image);  // brisemo postojecu fotografiju. Ova metoda po mom misljenju nije bas najbolja
            $product->image = $request->image->store('');
        }
        if ($product->isClean()) {
            throw new Exception("Morate izmeniti podatke", 422);
            
        }

         $product->save();

         return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function checkSeller(Seller $seller, Product $product)
    {
       if($seller->id != $product->seller_id)
       {
           throw new Exception("The specified seller is not actual seller of product", 422);
           
       }
    }
}
