<?php

namespace App\Http\Controllers;

use App\Models\animal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class animalcontroller extends Controller
{
    public function index(): JsonResponse
    {
        $animals = animal::all();
        return response()->json($animals);
    }

    public function store(Request $request): JsonResponse
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'date' => 'required|date',
            'animal_type' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id',

        ]);

        // إنشاء سجل جديد في قاعدة البيانات بدون رفع صورة
        $animal = Animal::create([
            'name' => $validated['name'],
            'age' => $validated['age'],
            'date' => $validated['date'],
            'animal_type' => $validated['animal_type'],
            'id_user' => $validated['id_user'],

        ]);

        return response()->json([
            'message' => 'Animal added successfully',
            'animal' => $animal,
        ], 201);
    }

}
