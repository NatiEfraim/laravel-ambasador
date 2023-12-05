<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    ///// main index function get all order
    public function index()
    {
        return Order::all();
    }
}
