<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    ///// main index function get all order
    public function index()
    {
        // Eager load the orderItems relationship
        // $orders = Order::with('orderItems')->get();
        // return OrderResource::collection($orders);




        return OrderResource::collection(Order::with("orderItems")->get());
        // return OrderResource::collection(Order::all());
    }
}
