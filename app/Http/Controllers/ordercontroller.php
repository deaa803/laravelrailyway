<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\JsonResponse;

class ordercontroller extends Controller
{
    public function index(): JsonResponse
    {
        $orders = order::all();
        return response()->json($orders);
    }
}
