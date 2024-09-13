<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizMatchRequest;
use App\Http\Requests\ScoreRequest;
use App\MatchType;
use App\Models\QuizMatch;
use App\Models\Team;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Adapter\CPDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class QuizMatchController extends Controller
{
    public function index(Request $request): Response{
        Gate::authorize('viewAny', QuizMatch::class);

        return Inertia::render('QuizMatches/Index', [
            'matches' => QuizMatch::orderBy('updated_at', 'desc')->with(['localTeam', 'guestTeam'])->get(),
            'teams' => Team::all(),
            'matchTypes' => array_filter(MatchType::cases(), function ($match){
                return $match->value != 'regular';
            }),
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
            'scored_points' => $match->type == 'regular' ? $localTeam->scored_points + $validated['local_score'] : $localTeam->scored_points,
            'conceded_points' => $match->type == 'regular' ? $localTeam->conceded_points + $validated['guest_score'] : $localTeam->conceded_points
        ]);

        $guestTeam->update([
            'won_matches' => $validated['guest_score'] > $validated['local_score'] ? ++$guestTeam->won_matches : $guestTeam->won_matches,
            'lost_matches' => $validated['guest_score'] < $validated['local_score'] ? ++$guestTeam->lost_matches : $guestTeam->lost_matches,
            'drawn_matches' => $validated['guest_score'] == $validated['local_score'] ? ++$guestTeam->drawn_matches : $guestTeam->drawn_matches,
            'scored_points' => $match->type == 'regular' ? $guestTeam->scored_points + $validated['guest_score'] : $guestTeam->scored_points,
            'conceded_points' => $match->type == 'regular' ? $guestTeam->conceded_points + $validated['local_score'] : $guestTeam->conceded_points
        ]);

        return to_route('quizMatches.index', [
            'showModal' => true,
            'modalTitle' => 'Puntuaciones registradas!',
            'modalMessage' => 'EBN Tuxtla 2024'
        ]);
    }

    public function store(QuizMatchRequest $request): RedirectResponse{
        $validated = $request->validated();

        QuizMatch::create($validated);

        return to_route('quizMatches.index', [
            'showModal' => true,
            'modalTitle' => 'Competencia creada!',
            'modalMessage' => 'Ya casi tenemos campeón'
        ]);
    }

    public function download(Request $request, int $matchId) {
        Gate::authorize('download', QuizMatch::class);
        $match = QuizMatch::where('id', $matchId)->first();

        $types = [
            'regular' => '',
            'quarter_final' => '4os',
            'semi_final' => 'Semi',
            'third' => '3er',
            'final' => 'Final',
        ];

        $pdf = Pdf::loadView('quizMatches.score'. $types[$match->type], [
            'match' => $match->load(['localTeam', 'guestTeam']),
            'publicPath' => env('PUBLIC_FOLDER'),
            'isLocalEnv' => App::environment('local')
        ]);

        $options = $pdf->getOptions();
        $options->setFontCache(storage_path('fonts'));
        $options->set('isRemoteEnabled', true);
        $options->set('pdfBackend', 'CPDF');
        $options->setChroot([
            'resources/views/',
            storage_path('fonts'),
            storage_path('images'),
        ]);

        return $pdf->stream("Score.pdf");
    }
}
