<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreRequest;
use App\MatchType;
use App\Models\QuizMatch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class QuizMatchController extends Controller
{
    public function index(Request $request): Response{
        Gate::authorize('viewAny', QuizMatch::class);

        return Inertia::render('QuizMatches/Index', [
            'matches' => QuizMatch::orderBy('updated_at', 'desc')->with(['localTeam', 'guestTeam'])->get(),
            'matchTypes' => MatchType::cases(),
            'showModal' => array_key_exists('showModal', $request->query()),
            'modalTitle' => array_key_exists('modalTitle', $request->query()) ? $request->query('modalTitle') : null,
            'modalMessage' => array_key_exists('modalMessage', $request->query()) ? $request->query('modalMessage') : null
        ]);
    }

    public function update(ScoreRequest $request): RedirectResponse{
        $validated = $request->validated();
        $match = QuizMatch::find($validated['id']);
        $localTeam = $match->localTeam;
        $guestTeam = $match->guestTeam;

        $match->update([
            'local_score' => $validated['local_score'],
            'guest_score' => $validated['guest_score']
        ]);

        $localTeam->update([
            'won_matches' => $validated['local_score'] > $validated['guest_score'] ? ++$localTeam->won_matches : $localTeam->won_matches,
            'lost_matches' => $validated['local_score'] < $validated['guest_score'] ? ++$localTeam->lost_matches : $localTeam->lost_matches,
            'drawn_matches' => $validated['local_score'] == $validated['guest_score'] ? ++$localTeam->drawn_matches : $localTeam->drawn_matches,
            'points_scored' => $validated['local_score'],
            'points_conceded' => $validated['guest_score']
        ]);

        $guestTeam->update([
            'won_matches' => $validated['guest_score'] > $validated['local_score'] ? ++$guestTeam->won_matches : $guestTeam->won_matches,
            'lost_matches' => $validated['guest_score'] < $validated['local_score'] ? ++$guestTeam->lost_matches : $guestTeam->lost_matches,
            'drawn_matches' => $validated['guest_score'] == $validated['local_score'] ? ++$guestTeam->drawn_matches : $guestTeam->drawn_matches,
            'points_scored' => $validated['guest_score'],
            'points_conceded' => $validated['local_score']
        ]);

        return to_route('quizMatches.index', [
            'showModal' => true,
            'modalTitle' => 'Puntuaciones registradas!',
            'modalMessage' => 'EBN Tuxtla 2024'
        ]);
    }
}
