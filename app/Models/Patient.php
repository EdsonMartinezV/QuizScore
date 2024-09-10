<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $connection = 'mysqlservicios';
    protected $table = 'Tbl_Padron_Maestro';
    protected $primaryKey = 'Pk_PadronMaestro';

    protected $visible = [
        'Pk_PadronMaestro',
        'Rfc_PM',
        'Nombre_PM',
        'ApePat_PM',
        'ApeMat_PM',
        'name',
        'paternal_surname',
        'maternal_surname',
        'affiliation_number'
    ];

    protected $hidden = [
        'patientSnapshots'
    ];

    protected $appends = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'sector_name',
        'marital_status_name',
        'municipality_name',
        'formatted_kinship',
        'affiliation_number'
    ];

    protected function name(): Attribute{
        return new Attribute(
            get: fn () => str_contains($this->Nombre_PM, 'ï¿½') ? str_replace('ï¿½', 'Ñ', $this->Nombre_PM) : $this->Nombre_PM
        );
    }

    protected function paternalSurname(): Attribute{
        return new Attribute(
            get: fn () => str_contains($this->ApePat_PM, 'ï¿½') ? str_replace('ï¿½', 'Ñ', $this->ApePat_PM) : $this->ApePat_PM
        );
    }

    protected function maternalSurname(): Attribute{
        return new Attribute(
            get: fn () => str_contains($this->ApeMat_PM, 'ï¿½') ? str_replace('ï¿½', 'Ñ', $this->ApeMat_PM) : $this->ApeMat_PM
        );
    }

    protected function sectorName(): Attribute{
        return new Attribute(
            get: fn () => $this->sector->Descripcion_Sector
        );
    }

    protected function maritalStatusName(): Attribute{
        return new Attribute(
            get: fn () => $this->maritalStatus->EstadoCivil
        );
    }

    protected function municipalityName(): Attribute{
        return new Attribute(
            get: fn () => $this->municipality->Nombre_Municipio
        );
    }

    protected function formattedKinship(): Attribute{
        return new Attribute(
            get: fn () => str_pad($this->TipoParent_PM, 2, '0', STR_PAD_LEFT)
        );
    }

    protected function affiliationNumber(): Attribute{
        return new Attribute(
            get: fn () => "$this->Rfc_PM-$this->formatted_kinship"
        );
    }

    public function sector(): BelongsTo{
        return $this->belongsTo(Sector::class, 'sector_PM');
    }

    public function patientSnapshots(): HasMany{
        return $this->hasMany(PatientSnapshot::class, 'patient_id');
    }

    public function maritalStatus(): BelongsTo{
        return $this->belongsTo(MaritalStatus::class, 'edo_civil')->withDefault([
            'Pk_EstadoCivil' => 1,
            'EstadoCivil' => 'SOLTERO(A)'
        ]);
    }

    public function municipality(): BelongsTo{
        return $this->belongsTo(Municipality::class, 'Muni_PM');
    }
}
