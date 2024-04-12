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
        $shop = new Shop();
        $shop->user_id = Auth::user()->id; // Assign the user_id from the request
        $shop->name = $request->input('name');
        $shop->theme = $request->input('theme');
        $shop->biography = $request->input('biography');

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
        // Find the shop by ID
        $shop = Shop::find($id);

        // Update the shop attributes
        $shop->update($request);

        return response()->json(['message' => 'Shop updated successfully', 'shop' => $shop], 200);
    }

    public function destroy($id)
    {
        // Find the shop by ID
        $shop = Shop::findOrFail($id);

        // Delete the shop
        $shop->delete();

        return response()->json(['message' => 'Shop deleted successfully'], 200);
    }
}
