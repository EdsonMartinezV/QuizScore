<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_Municipios';
    protected $primaryKey = 'PK_Municipio';

    public function patients(): HasMany{
        return $this->hasMany(Patient::class, 'Muni_PM');
    }
}
