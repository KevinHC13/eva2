<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    /**
     * Almacena los archivos recibidos en la solicitud.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $archivos = $request->file('file');
        $nomres = [];
        $archivosPath = [];
        $id = Str::uuid();

        $extention_validate = false;

        // Validar si hay al menos 2 archivos y sus extensiones son diferentes
        if (is_array($archivos) && count($archivos) >= 2) {
            if ($archivos[0]->getClientOriginalExtension() == $archivos[1]->getClientOriginalExtension()) {
                return response()->json([
                    'res' => false
                ]);
            }
        } else {
            return response()->json([
                'res' => false
            ]);
        }

        // Mover los archivos a la carpeta de almacenamiento y guardar sus nombres
        foreach ($archivos as $archivo) {
            $nombreArchivo = $id . '.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads'), $nombreArchivo);
            $nomres[] = $nombreArchivo;
            $archivosPath[] = public_path('uploads') . '/' . $nombreArchivo;
        }

        return response()->json([
            'id' => $id
        ]);
    }
}
