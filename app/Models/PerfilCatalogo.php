<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilCatalogo extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "perfil_catalogo";
    protected $keyType = 'string';

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_catalogo', 'id');
    }
}
