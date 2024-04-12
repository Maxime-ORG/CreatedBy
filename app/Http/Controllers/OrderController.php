<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve all shops
        $orders = Order::all();

        return response()->json(['orders' => $orders], 200);
    }

    public function show($id)
    {
        // Retrieve a single shop by ID
        $order = Order::find($id);

        return response()->json(['order' => $order], 200);
    }

    /**
     * @throws ValidationException
     */
    public function create(Request $request)
    {


        $order = new Order();
        $order->user_id = $request->input('user_id'); // Assign the user_id from the request
        $order->product_price = $request->input('product_price'); // Assign the user_id from the request
        $order->command_number = $request->input('command_number'); // Assign the user_id from the request
        $order->date = $request->input('date');

        // Save the shop to the database
        $order->save();

        return response()->json(['message' => 'Shop created successfully', 'order' => $order], 201);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'command_number' => 'required|string|uuid',
            'date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Find the shop by ID
        $order = Order::find($id);

        // Update the shop attributes
        $order->update($validatedData);

        return response()->json(['message' => 'Shop updated successfully', 'order' => $order], 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        // If the product doesn't exist, return an error response
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        try {
            // Attempt to delete the product
            $order->delete();
            return response()->json(['message' => 'Order deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log any error that occurs during deletion
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete order'], 500);
        }
    }
}
