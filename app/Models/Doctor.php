<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Doctor extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_Medico';
    protected $primaryKey = 'Pk_Medico';

    public function user(): HasOne{
        return $this->hasOne(User::class, 'Fk_Medico_Usuario');
    }
}
