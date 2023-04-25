<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        //add validation and return error message
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'availabe_items' => 'required',
            'description' => 'required',
        ]);

        try {
            $save_product = Product::create([

                'member_id' => $request->member_id,
                'name' => $request->product_name,
                'price' => $request->price,
                'stock' => $request->availabe_items,
                'description' => $request->description,
            ]);

            return response()->json(['data' => $save_product, 'code' => 200]);
        } catch (\Throwable $th) {

            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }

    //getProducts
    public function getProducts($id)
    {
        try {
            $products = Product::where('member_id', $id)->get();
            return response()->json(['data' => $products, 'code' => 200]);
        } catch (\Throwable $th) {

            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }

    //productDetails
    public function productDetails($id)
    {
        try {
            $product = Product::where('id', $id)->first();
            return response()->json(['data' => $product, 'code' => 200]);
        } catch (\Throwable $th) {

            return response()->json(['data' => $th->getMessage(), 'code' => 500]);
        }
    }
}
