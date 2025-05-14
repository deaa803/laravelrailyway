<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Product;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }


    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'product_id' => 'required|integer|exists:products,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imagePath =null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        $order = order::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'product_id' => $validated['product_id'],
            'image' => $imagePath,
        ]);
        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
        ], 201);


    }

}




