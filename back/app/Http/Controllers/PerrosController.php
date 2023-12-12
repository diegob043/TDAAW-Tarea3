<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ListarPerroRequest, PerroRequest, PerroUpdateRequest};
use Illuminate\Http\Request;
use App\Repositories\PerroRepository;

class PerrosController extends Controller
{
    protected PerroRepository $perroRepository;

    public function __construct(PerroRepository $perroRepository)
    {
        $this->perroRepository = $perroRepository;
    }

    public function registrarPerro(PerroRequest $request)
    {
        return $this->perroRepository->registrarPerro($request);
    }

    public function actualizarPerro($id, PerroUpdateRequest $request)
{
    return $this->perroRepository->actualizarPerro($id, $request);
}

    public function listarPerros(Request $request)
    {
        return $this->perroRepository->listarPerros($request);
    }

    public function listarPerro($id, Request $request)
    {
        return $this->perroRepository->listarPerro($id, $request);
    }

    public function eliminarPerro($id)
    {
        return $this->perroRepository->eliminarPerro($id);
    }

    public function obtenerPerroAleatorio() {
        return $this->perroRepository->obtenerPerroAleatorio();
    }

    public function obtenerPerroInteresado(){
        return $this->perroRepository->obtenerPerroInteresado();
    }

}
