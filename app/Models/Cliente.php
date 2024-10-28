<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si es diferente al nombre del modelo
    protected $table = 'clientes'; // Nombre de la tabla en la base de datos

    // Opcional: Campos que pueden ser llenados
    protected $fillable = [
        'Nombre',
        'APaterno',
        'AMaterno',
        'Telefono',
        'Correo',
    ];
}