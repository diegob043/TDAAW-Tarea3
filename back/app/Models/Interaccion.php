<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'perro_interesado_id',
        'perro_candidato_id',
        'preferencia',
    ];

    public static function registrarInteraccion($perroInteresadoId, $perroCandidatoId, $preferencia)
    {
        // Verificar si existe un "match" entre los perros
        if (self::existeMatch($perroInteresadoId, $perroCandidatoId)) {
            return '¡Hay match!';
        } else {
            // Registrar la interacción en la base de datos
            self::create([
                'perro_interesado_id' => $perroInteresadoId,
                'perro_candidato_id' => $perroCandidatoId,
                'preferencia' => $preferencia,
            ]);

            return 'Ok';
        }
    }

    private static function existeMatch($perroInteresadoId, $perroCandidatoId)
    {
        // Verificar si existe una interacción previa entre los perros en cualquier orden
        return self::where(function ($query) use ($perroInteresadoId, $perroCandidatoId) {
            $query->where('perro_interesado_id', $perroInteresadoId)
                ->where('perro_candidato_id', $perroCandidatoId);
        })->orWhere(function ($query) use ($perroInteresadoId, $perroCandidatoId) {
            $query->where('perro_interesado_id', $perroCandidatoId)
                ->where('perro_candidato_id', $perroInteresadoId);
        })->exists();
    }
}