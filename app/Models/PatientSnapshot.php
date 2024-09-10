<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientSnapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'CURP',
        'RFC',
        'homonimia',
        'link',
        'kinship',
        'status',
        'name',
        'paternal_surname',
        'maternal_surname',
        'sector',
        'gender',
        'birth_date',
        'address',
        'residence_municipality',
        'residence_state',
        'coordination',
        'telephone',
        'cellphone',
        'marital_status',
        'postal_code',
        /* tertiarylevel */
        'birth_state',
        'birth_municipality',
        /* */
        'patient_id',
        'adscription_id'
    ];

    protected $appends = [
        'full_name',
        'age',
        'formatted_kinship',
        'adscription_place',
        'formatted_birth_date',
        'sinba_birth_date',
        'numbers_of_birth_date',
        'numbers_of_curp',
        'affiliation_number',
        'formatted_gender',
        'is_not_owner'
    ];

    protected function maritalStatus(): Attribute{
        return Attribute::make(
            get: fn (string $value) => $this->getMaritalStatus($value)
        );
    }

    protected function telephone(): Attribute{
        return Attribute::make(
            get: fn (string $value) => str_contains($value, '00 000') || $value == 0 ? '' : $value
        );
    }

    protected function fullName(): Attribute{
        return new Attribute(
            get: fn () => "$this->name $this->paternal_surname $this->maternal_surname"
        );
    }

    protected function age(): Attribute{
        return new Attribute(
            get: fn () => Carbon::now()->diffInYears($this->birth_date)
        );
    }

    protected function formattedKinship(): Attribute{
        return new Attribute(
            get: fn () => str_pad($this->kinship, 2, '0', STR_PAD_LEFT)
        );
    }

    protected function adscriptionPlace(): Attribute{
        return new Attribute(
            get: fn () => $this->adscription->medicalUnit->Descripcion_UniMed
        );
    }

    protected function formattedBirthDate(): Attribute{
        return new Attribute(
            get: fn () => (new Carbon($this->birth_date))->isoFormat('D/MMMM/Y')
        );
    }

    protected function sinbaBirthDate(): Attribute{
        return new Attribute(
            get: fn () => (new Carbon($this->birth_date))->isoFormat('DD/MM/Y')
        );
    }

    protected function numbersOfBirthDate(): Attribute{
        return new Attribute(
            get: fn () => str_split((new Carbon($this->birth_date))->isoFormat('DDMMY'))
        );
    }

    protected function numbersOfCurp(): Attribute{
        return new Attribute(
            get: fn () => str_split($this->CURP)
        );
    }

    protected function affiliationNumber(): Attribute{
        return new Attribute(
            get: fn () => "$this->RFC-$this->formatted_kinship"
        );
    }

    protected function formattedGender(): Attribute{
        return new Attribute(
            get: fn () => $this->gender === 'F' ? 'Femenino' : 'Masculino'
        );
    }

    protected function isNotOwner(): Attribute{
        return new Attribute(
            get: fn () => $this->kinship !== 1
        );
    }

    public function patient(): BelongsTo{
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function adscription(): BelongsTo{
        return $this->belongsTo(Adscription::class, 'adscription_id');
    }

    protected function getMaritalStatus(string $value): string{
        if (substr($value, strlen($value) - 3) === '(A)') {
            if ($this->gender === 'M') {
                return substr($value, 0, strlen($value) - 3);
            } else {
                return substr($value, 0, strlen($value) - 4) . 'A';
            }
        } else {
            return $value;
        }
    }
}
