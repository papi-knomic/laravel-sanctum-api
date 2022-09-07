<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $formFields =  $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);

      $formFields['user_id'] = auth()->id();
        return Product::create($formFields);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);

        if ( !$product ){
            return response([
                'message' => 'Product not found',
                'status' => false,
            ], 404);
        }
        if ( $product->user_id != auth()->id() ){
            return response([
                'message' => 'Unauthorized action',
                'status' => false,
            ], 403);
        }

       if (  Product::destroy($product->id ) ) {
          return response([
              'message' => 'Product deleted',
              'status' => true,
          ]);
       }

        return response([
            'message' => 'Product could not be deleted',
            'status' => false,
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
        return response([
            'message' => 'Products gotten',
            'status' => true,
            'data' => Product::where('name', 'like', '%'.$name.'%')->get()
        ]);

    }

    public function products( Request $request )
    {
        return response([
            'message' => 'Products gotten',
            'status' => true,
            'data' => auth()->user()->products()->get()
        ]);
    }

}
