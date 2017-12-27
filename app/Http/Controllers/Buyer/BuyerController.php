<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Buyer;
use App\User;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();

        return $this->showAll($buyers);
    }

   
    public function show($id)
    {
        $buyer =  Buyer::has('transactions')->findOrFail($id);
     
        return response()->json(['data'=>$buyer],200);
    }

    
}
