<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CIE10Key extends Model
{
    use HasFactory;

    protected $connection = 'mysqlcatalogos';
    protected $table = 'Cat_DetalleCIE10';
    protected $primaryKey = 'Pk_DetalleCIE10';
}
