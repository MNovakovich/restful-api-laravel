<?php

namespace App\Http\Controllers;


use App\Traits\ApiResponser;  // we add apstract class for api requests

use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponser
}
