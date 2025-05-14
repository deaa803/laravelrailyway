<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);
            $product = Product::findOrFail($validated['product_id']);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $cartItem = CartItem::create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);

            return response()->json([
                'message' => 'Cart item created successfully',
                'data' => $cartItem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getItems(): JsonResponse
    {
        $items = cartItem::with('product')->get();
        return response()->json([$items]);
    }

    public function updateItem(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $item = cartItem::findOrFail($id);
        $item->update(['quantity' => $validated['quantity']]);
        return response()->json([
            'message' => 'Item updated',
            'item' => $item
        ]);
    }
    public function deleteItem($id): JsonResponse
    {
        $item = CartItem::findOrFail($id);
        $item->delete();
        return response()->json([
            'message' => 'Item deleted'
        ]);
    }




}
