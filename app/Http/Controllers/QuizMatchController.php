<?php

namespace App\Http\Controllers;

use App\MatchType;
use App\Models\QuizMatch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuizMatchController extends Controller
{
    public function index(Request $request): Response{
        return Inertia::render('QuizMatches/Index', [
            'matches' => QuizMatch::orderBy('updated_at', 'desc')->with(['localTeam', 'guestTeam'])->get(),
            'matchTypes' => MatchType::cases()
        ]);
    }
}
