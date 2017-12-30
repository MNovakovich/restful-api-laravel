<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

use App\Models\Transaction;

class TransactionController extends ApiController
{
    
    public function index()
    {
        $transactions = Transaction::all();

        return  $this->showAll($transactions);
    }

   
    
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

         return $this->showOne($transaction);
        // return response()->json(['date'=>$transaction, 'code'=>200],200);
    }

   

    
    public function destroy($id)
    {
        
    }
}
