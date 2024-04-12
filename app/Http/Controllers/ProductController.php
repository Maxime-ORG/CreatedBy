<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all products from the database
        $products = Product::all();

        return $products;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Create a new product instance
        $product = new Product();

        // Set product attributes
        $product->id = $request->get('id');
        $product->shop_id = $request->get('shop_id');
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->story = $request->get('story');
        $product->price = $request->get('price');
        $product->quantity = $request->get('quantity');
        $product->image = $request->get('image');

        // Save the product to the database
        $product->save();

        // Return a response indicating success
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find the product by ID
            $product = Product::find($id);

            // If the product doesn't exist, return an error response
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            // Update the product attributes
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->quantity = $request->input('quantity');
            $product->image = $request->input('image');

            // Save the updated product
            $product->save();

            return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
        } catch (\Exception $e) {
            // Log any error that occurs during update
            Log::error('Error updating product: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update product'], 500);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        // Find the product by ID
        $product = Product::find($id);

        // If the product doesn't exist, return an error response
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        try {
            // Attempt to delete the product
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log any error that occurs during deletion
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete product'], 500);
        }
    }

    public function search(string $name)
    {
        $product = Product::where('name', $name)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        } elseif ($product) {
            return $product;
        }
    }

    public function category(string $name)
    {
        $products = Product::whereHas('categories', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();

        return $products;
    }

    public function material(string $name)
    {
        $products = Product::whereHas('materials', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();

        return $products;
    }

    public function color(string $name)
    {
        $products = Product::whereHas('colors', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();

        return $products;
    }

    public function size(string $name)
    {
        $products = Product::whereHas('sizes', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();

        return $products;
    }

    public function order(string $id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $order = new Order();
        $order->command_number = uniqid();
        $order->date = now();
        $order->product_price = $product->price;

        $order->save();

        $order->products()->attach($product);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}
