<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        return response([
            'message' => 'Products retrieved',
            'status' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $formFields = $request->validated();
        $product =  Product::create($formFields);

        return response([
            'message' => 'Products created',
            'status' => true,
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response([
            'message' => 'Product retrieved',
            'status' => true,
            'data' => $product
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return response([
            'message' => 'Product updated',
            'status' => true,
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response([
            'message' => 'Product deleted',
            'status' => true,
        ]);
    }

    /**
     * search for a name.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $products =  Product::where('name', 'like', '%'.$name.'%')->get();

        return response([
            'message' => 'Products gotten',
            'status' => true,
            'data' => $products
        ]);

    }

    public function products()
    {
        $user = auth()->user();
        $userProducts = $user->products;

        return response([
            'message' => 'Products retrieved for user',
            'status' => true,
            'data' => $userProducts
        ]);
    }

}
