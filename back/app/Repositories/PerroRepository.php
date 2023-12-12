<?php

namespace App\Repositories;

use App\Models\Perro;
use App\Models\Interaccion;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PerroRepository
{
    public function registrarPerro($request)
    {
        try {
            $perro = new Perro();
            $perro->nombre = $request->nombre;
            $perro->foto_url = $request->foto_url;
            $perro->descripcion = $request->descripcion;
            $perro->save();
            
            return response()->json(["perro" => $perro], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function actualizarPerro($id, $request)
{
    try {
        $perro = Perro::find($id);
        
        if (!$perro) {
            return response()->json(["error" => "Perro no encontrado"], Response::HTTP_NOT_FOUND);
        }
        
        $perro->nombre = $request->input('nombre', $perro->nombre);
        $perro->descripcion = $request->input('descripcion', $perro->descripcion);
        $perro->foto_url = $request->input('foto_url', $perro->foto_url);
        $perro->save();
        
        return response()->json(["perro" => $perro], Response::HTTP_OK);
    } catch (Exception $e) {
        Log::info([
            "error" => $e->getMessage(),
            "linea" => $e->getLine(),
            "file" => $e->getFile(),
            "metodo" => __METHOD__
        ]);

        return response()->json([
            "error" => $e->getMessage(),
            "linea" => $e->getLine(),
            "file" => $e->getFile(),
            "metodo" => __METHOD__
        ], Response::HTTP_BAD_REQUEST);
    }
}

    public function listarPerros($request)
    {
        try {
            if (isset($request->limit)) {
                $perros = Perro::orderBy('id', 'ASC')
                    ->take($request->limit)
                    ->get();
            } else {
                $perros = Perro::orderBy('id', 'ASC')
                    ->get();
            }
            
            return response()->json(["perros" => $perros], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);
    
            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarPerro($id, $request)
{
    try {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(["mensaje" => "Perro no encontrado"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["perro" => $perro], Response::HTTP_OK);
    } catch (Exception $e) {
        Log::info([
            "error" => $e->getMessage(),
            "linea" => $e->getLine(),
            "file" => $e->getFile(),
            "metodo" => __METHOD__
        ]);

        return response()->json([
            "error" => $e->getMessage(),
            "linea" => $e->getLine(),
            "file" => $e->getFile(),
            "metodo" => __METHOD__
        ], Response::HTTP_BAD_REQUEST);
    }
}

public function eliminarPerro($id)
{
    try {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(["error" => "Perro no encontrado"], Response::HTTP_NOT_FOUND);
        }

        $perro->deleted_at = now();
        $perro->save();

        return response()->json(["perro" => $perro], Response::HTTP_OK);
    } catch (Exception $e) {
        Log::info([
            "error" => $e->getMessage(),
            "linea" => $e->getLine(),
            "file" => $e->getFile(),
            "metodo" => __METHOD__
        ]);

        return response()->json([
            "error" => $e->getMessage(),
            "linea" => $e->getLine(),
            "file" => $e->getFile(),
            "metodo" => __METHOD__
        ], Response::HTTP_BAD_REQUEST);
    }
}

public function obtenerPerroAleatorio() {
    $url = 'https://dog.ceo/api/breeds/list/all';
    $contenido = file_get_contents($url);
    $razas = json_decode($contenido, true);

    if ($razas && isset($razas['message'])) {
        $razasArray = $razas['message'];
        $razasClaves = array_keys($razasArray);

        $razaAleatoria = $razasClaves[array_rand($razasClaves)];


        $nombre = $razaAleatoria;
        $id = mt_rand(1, 20); 

        $perro = [
            'nombre' => $nombre,
            'id' => $id
        ];

        return $perro;
        
    } else {
        return ['error' => 'Error al obtener la lista de razas de perros.'];
    }
}


public function obtenerPerroInteresado()
{
    $perroInteresado = $this->obtenerPerroAleatorio();
    $perroCandidato = $this->obtenerPerroAleatorio();
    $preferencia = (mt_rand(0, 1) === 0) ? 'A' : 'R';

    
    $idPerroInteresado = $perroInteresado['id'];
    $idPerroCandidato = $perroCandidato['id'];

    $perros = [
        'Interesado' => $perroInteresado,
        'Candidato' => $perroCandidato,
        'Preferencia' => $preferencia
    ];

    
    $interaccion = new Interaccion();
    $interaccion->perroInteresado_id = $idPerroInteresado;
    $interaccion->perroCandidato_id = $idPerroCandidato;
    $interaccion->preferencia = $preferencia;
    $interaccion->save();

    return response()->json($perros);
}

public function obtenerPerrosAceptados($idPerroInteresado)
{
    try {
        $perrosAceptados = Interaccion::where('perroInteresado_id', $idPerroInteresado)
            ->where('preferencia', 'A')
            ->pluck('perroCandidato_id')
            ->toArray();

        $response = ['perrosAceptados' => []];
        foreach ($perrosAceptados as $perro) {
            $response['perrosAceptados'][] = ['perroCandidato_id' => $perro];
        }

        return response()->json($response, Response::HTTP_OK);
    } catch (Exception $e) {
      
        return response()->json(['error' => 'Ocurrió un error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    public function obtenerPerrosRechazados($idPerroInteresado)
{
    try {
        $perrosAceptados = Interaccion::where('perroInteresado_id', $idPerroInteresado)
            ->where('preferencia', 'R')
            ->pluck('perroCandidato_id')
            ->toArray();

        $response = ['perrosRechazados' => []];
        foreach ($perrosAceptados as $perro) {
            $response['perrosRechazados'][] = ['perroCandidato_id' => $perro];
        }

        return response()->json($response, Response::HTTP_OK);
    } catch (Exception $e) {
      
        return response()->json(['error' => 'Ocurrió un error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

}
