<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    use HasUuids;


    protected $table = "perfil";
    protected $keyType = 'string';

    public function perfil_catalogo()
    {
        return $this->hasMany(PerfilCatalogo::class, 'id', 'id_catalogo');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
