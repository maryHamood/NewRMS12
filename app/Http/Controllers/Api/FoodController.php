<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('category')->get();
        return response()->json($foods);
    }


    public function search(Request $request)
    {
        $query = $request->input('q');

        $foods = Food::where('name', 'LIKE', '%' . $query . '%')
            ->with('category')
            ->get();

        return response()->json($foods);
    }


    public function show($id)
    {
        $food = Food::with('category')->find($id);

        if (!$food) {
            return response()->json(['message' => 'الطعام غير موجود'], 404);
        }

        return response()->json($food);
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
