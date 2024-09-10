<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_Sector';
    protected $primaryKey = 'Pk_Sector';

    public function patientSnapshots(): HasMany{
        return $this->hasMany(PatientSnapshot::class, 'sector_id');
    }
}
