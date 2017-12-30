<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Transaction;

class TransactionSellerController extends ApiController
{
   
   
    public function index(Transaction $transaction)
    {
       $seller = $transaction->product->seller;

        return $this->showOne($seller);
    }

}
