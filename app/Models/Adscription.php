<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adscription extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_Adscripcion';
    protected $primaryKey = 'Pk_Adscripcion';

    public function patientSnapshots(): HasMany{
        return $this->hasMany(PatientSnapshot::class, 'adscription_id');
    }

    public function medicalUnit(): BelongsTo{
        return $this->belongsTo(MedicalUnit::class, 'Fk_Unimed_Adscripcion');
    }
}
