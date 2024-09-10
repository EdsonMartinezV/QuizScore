<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalUnit extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_UniMed';
    protected $primaryKey = 'Pk_UniMed';

    protected function adscriptions(): HasMany{
        return $this->hasMany(Adscription::class, 'Fk_Unimed_Adscripcion');
    }
}
