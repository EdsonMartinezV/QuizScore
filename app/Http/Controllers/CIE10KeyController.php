<?php

namespace App\Http\Controllers;

use App\Models\CIE10Key;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CIE10KeyController extends Controller
{
    public function jsonIndex(Request $request) {
        $q = $request->query('q') ? $request->query('q') : '';
        $params = $request->query('fields');

        if ($q !== '') {
            $keys = CIE10Key::select([
                'Pk_DetalleCIE10',
                'Codigo_DetalleCIE10',
                'Descripcion_DetalleCIE10'
            ])->where(function (Builder $query) use ($q, $params) {
                foreach ($params as $param) {
                    $query->orWhere($param, 'like', "%$q%");
                }
            })->get();
        } else {
            $keys = [];
        }

        return $keys;
    }
}
