<?php

namespace App\Http\Controllers;

use App\Models\vet;
use Illuminate\Http\JsonResponse;

class vetcontroller extends Controller
{
    public function index(): JsonResponse
    {
        $vet = vet::all();
        return response()->json($vet);
    }
}
