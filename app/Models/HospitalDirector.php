<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalDirector extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'professional_license',
        'doctor_id'
    ];

    protected $appends = [
        'full_name'
    ];

    protected function fullName(): Attribute{
        return new Attribute(
            get: fn () => "$this->name $this->paternal_surname $this->maternal_surname"
        );
    }

    public function doctor(): BelongsTo{
        return $this->belongsTo(Doctor::class);
    }
}
