<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        // Aquí podrías consultar tu base de datos con: Place::all();
        // Por ahora, devolvemos este JSON de prueba
        return response()->json([
            'places' => [
                ['id' => 1, 'name' => 'Cristo de la Concordia', 'description' => 'Estatua gigante en Cochabamba'],
                ['id' => 2, 'name' => 'Parque de la Familia', 'description' => 'Un lugar muy bonito cerca del Prado']
            ]
        ]);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Lugar creado correctamente'], 201);
    }
}