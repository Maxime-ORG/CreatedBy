<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ShopController extends Controller
{
    public function index()
    {
        // Retrieve all shops
        $shops = Shop::all();

        return response()->json(['shops' => $shops], 200);
    }

    public function show($id)
    {
        // Retrieve a single shop by ID
        $shop = Shop::find($id);

        return response()->json(['shop' => $shop], 200);
    }

    /**
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'theme' => 'nullable|string',
            'biography' => 'nullable|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create a new shop based on validated data
        $validatedData = $validator->validated();

        $shop = new Shop();
        $shop->user_id = Auth::user()->id; // Assign the user_id from the request
        $shop->name = $validatedData['name'];
        $shop->theme = $validatedData['theme'];
        $shop->biography = $validatedData['biography'];

        // Save the shop to the database
        $shop->save();

        return response()->json(['message' => 'Shop created successfully', 'shop' => $shop], 201);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('update-shop', $request)) {
            // Validate incoming request data
            $validatedData = $request->validate([
                'user_id' => 'required|string|uuid',
                'name' => 'required|string',
                'theme' => 'nullable|string',
                'biography' => 'nullable|string',
            ]);

            // Find the shop by ID
            $shop = Shop::find($id);

            // Update the shop attributes
            $shop->update($validatedData);

            return response()->json(['message' => 'Shop updated successfully', 'shop' => $shop], 200);
        } else {
            return 'unauthorized';
        }

    }

    public function destroy($id)
    {
        if (Gate::allows('delete-shop', $id)) {

            // Find the shop by ID
            $shop = Shop::findOrFail($id);

            // Delete the shop
            $shop->delete();

            return response()->json(['message' => 'Shop deleted successfully'], 200);
        } else{
            return 'unauthorized';
        }
    }
}
