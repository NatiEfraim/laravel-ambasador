<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /////Get all products
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /////Post request to create a new product
        $product = Product::create($request->only("title", "description", "image", "price"));
        return response($product, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        /////return product by id.
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //////post request for PUT product.
        $product->update($request->only("title", "description", "image", "price"));
        return response($product, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        /////POST request to delete product
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
