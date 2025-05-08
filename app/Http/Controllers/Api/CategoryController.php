<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Food;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

  
    public function search(Request $request)
    {
        $query = $request->input('q'); // استلام الكلمة المفتاحية

        $categories = Category::where('name', 'LIKE', '%' . $query . '%')->get();
       
        return response()->json($categories);
    }
    public function searchall(Request $request)
    {
        $query = $request->input('q'); // استلام الكلمة المفتاحية

        $categories = Category::where('name', 'LIKE', '%' . $query . '%')->get();
        $foods = Food::where('name', 'LIKE', '%' . $query . '%')
        ->with('category')
        ->get();
        return response()->json([$categories,$foods]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
