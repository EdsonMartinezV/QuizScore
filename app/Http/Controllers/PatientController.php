<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function jsonIndex(Request $request) {
        $q = $request->query('q') ? $request->query('q') : '';
        $params = $request->query('fields');

        if ($q !== '') {
            $patients = Patient::whereIn('Estatus_PM', ['A', 'S'])
                ->where(function (Builder $query) use ($q, $params) {
                    foreach ($params as $param) {
                        $query->orWhere($param, 'like', "%$q%");
                    }
                })->get();
        } else {
            $patients = [];
        }

        return $patients;
    }
}
