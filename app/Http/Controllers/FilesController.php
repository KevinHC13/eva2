<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    public function store(Request $request)
    {
        $archivos = $request->file('file');
        $nomres = [];
        $archivosPath = [];
        $id = Str::uuid();
    
        foreach ($archivos as $archivo){
            $nombreArchivo = $id . '.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads'), $nombreArchivo);
            $nomres[] = $nombreArchivo;
            $archivosPath[] = public_path('uploads') . '/' . $nombreArchivo;
        }
    
        return response()->json([
            'id' => $id
        ]);
    }}
