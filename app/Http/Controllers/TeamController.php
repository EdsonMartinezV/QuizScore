<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function index(Request $request): Response{
        Gate::authorize('viewAny', Team::class);

        return Inertia::render('Teams/Index', [
            'teams' => Team::orderBy('won_matches', 'desc')->orderBy('scored_points', 'desc')->orderBy('point_spread', 'desc')->get(),
            'showModal' => array_key_exists('showModal', $request->query()),
            'modalTitle' => array_key_exists('modalTitle', $request->query()) ? $request->query('modalTitle') : null,
            'modalMessage' => array_key_exists('modalMessage', $request->query()) ? $request->query('modalMessage') : null
        ]);
    }
}
