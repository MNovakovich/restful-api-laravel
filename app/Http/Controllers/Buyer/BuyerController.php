<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\ApiController;

use App\Models\Buyer;
use App\User;

class BuyerController extends ApiController
{

    public function index()
    {
        $buyers = Buyer::has('transactions')->get();

        return response()->json(['data'=>$buyers],200);

        // we created interface class ApiResponser 
        //return $this->showAll($buyers);
    }

   
    public function show($id)
    {
        $buyer =  Buyer::has('transactions')->findOrFail($id);
     
        // return response()->json(['data'=>$buyer],200);

        return $this->showOne($buyer, 200);
    }

    
}
