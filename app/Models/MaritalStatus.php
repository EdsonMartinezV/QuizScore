<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_EstadoCivil';
    protected $primaryKey = 'Pk_EstadoCivil';

    public function patients(): HasMany{
        return $this->hasMany(Patient::class, 'edo_civil');
    }
}
