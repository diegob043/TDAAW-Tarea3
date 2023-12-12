<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PerroRepository;
use App\Http\Requests\{InteraccionRequest, ListarInteraccionRequest};

class InteraccionController extends Controller
{
    
    protected PerroRepository $perroRepository;

    public function __construct(PerroRepository $perroRepository)
    {
        $this->perroRepository = $perroRepository;
    }

    public function obtenerPerrosAceptados($idPerroInteresado){
        return $this->perroRepository->obtenerPerrosAceptados($idPerroInteresado);
    }

    public function obtenerPerrosRechazados($idPerroInteresado){
        return $this->perroRepository->obtenerPerrosRechazados($idPerroInteresado);
    }


}
