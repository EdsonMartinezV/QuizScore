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
use Illuminate\Support\Facades\Storage;
use Ilovepdf\Ilovepdf;
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

        $oldLocalScore = $match->local_score;
        $oldGuestScore = $match->guest_score;

        $oldLocalWon = $oldLocalScore > $oldGuestScore;
        $oldGuestWon = $oldGuestScore > $oldLocalScore;
        $oldDrawn = $oldLocalScore == $oldGuestScore;

        $newLocalWon = $validated['local_score'] > $validated['guest_score'];
        $newGuestWon = $validated['guest_score'] > $validated['local_score'];
        $newDrawn = $validated['guest_score'] == $validated['local_score'];

        /* $oldLocalWins = $localTeam->won_matches;
        $oldLocalLosts = $localTeam->lost_matches;
        $oldLocalDrawns = $localTeam->drawn_matches;

        $oldGuestWins = $guestTeam->won_matches;
        $oldGuestLosts = $guestTeam->lost_matches;
        $oldGuestDrawns = $guestTeam->drawn_matches; */

        $match->update([
            'local_score' => $validated['local_score'],
            'guest_score' => $validated['guest_score'],
        ]);

        if (!$match->has_changed) {
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
        } else {
            $localTeam->update([
                'won_matches' => ($oldGuestWon || $oldDrawn) && $newLocalWon ? ++$localTeam->won_matches : ($oldLocalWon && ($newGuestWon || $newDrawn) ? --$localTeam->won_matches : $localTeam->won_matches),
                'lost_matches' => ($oldLocalWon || $oldDrawn) && $newGuestWon ? ++$localTeam->lost_matches : ($oldGuestWon && ($newLocalWon || $newDrawn) ? --$localTeam->lost_matches : $localTeam->lost_matches),
                'drawn_matches' => !$oldDrawn && $newDrawn ? ++$localTeam->drawn_matches : ($oldDrawn && !$newDrawn ? --$localTeam->drawn_matches : $localTeam->drawn_matches),
                'scored_points' => $match->type == 'regular' ? $localTeam->scored_points + $validated['local_score'] - $oldLocalScore : $localTeam->scored_points,
                'conceded_points' => $match->type == 'regular' ? $localTeam->conceded_points + $validated['guest_score'] - $oldGuestScore : $localTeam->conceded_points
            ]);

            $guestTeam->update([
                'won_matches' => ($oldLocalWon || $oldDrawn) && $newGuestWon ? ++$guestTeam->won_matches : ($oldGuestWon && ($newLocalWon || $newDrawn) ? --$guestTeam->won_matches : $guestTeam->won_matches),
                'lost_matches' => ($oldGuestWon || $oldDrawn) && $newLocalWon ? ++$guestTeam->lost_matches : ($oldLocalWon && ($newGuestWon || $newDrawn) ? --$guestTeam->lost_matches : $guestTeam->lost_matches),
                'drawn_matches' => !$oldDrawn && $newDrawn ? ++$guestTeam->drawn_matches : ($oldDrawn && !$newDrawn ? --$guestTeam->drawn_matches : $guestTeam->drawn_matches),
                'scored_points' => $match->type == 'regular' ? $guestTeam->scored_points + $validated['guest_score'] - $oldGuestScore : $guestTeam->scored_points,
                'conceded_points' => $match->type == 'regular' ? $guestTeam->conceded_points + $validated['local_score'] - $oldLocalScore : $guestTeam->conceded_points
            ]);
        }

        $match->update([
            'has_changed' => true,
            'downloaded' => false
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

        $match->update([
            'downloaded' => false
        ]);

        if (!Storage::exists("public/scores/$match->id/$match->localTeamIdName-$match->guestTeamIdName-0001.jpg") || $match->has_changed){
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

            $pdf->save("public/scores/$match->id/$match->localTeamIdName-$match->guestTeamIdName.pdf", 'local');

            $love = new Ilovepdf('project_public_60fe87a68f6813853d3595269322bb07_b_sBzedffdb57573e29748a8e0fae2fd4d3ef', 'secret_key_d875f8437e476cc15641885cbcaebc3f_RCqMXb54821ac7b6bb0d313394157517a9dd8');
            $task = $love->newTask('pdfjpg');
            $file = $task->addFile(storage_path("app/public/scores/$match->id/$match->localTeamIdName-$match->guestTeamIdName.pdf"));
            $task->execute();
            $task->download(storage_path("app/public/scores/$match->id"));
            $match->update([
                'has_changed' => false,
                'downloaded' => true
            ]);
        }

        return response()->download(storage_path("app/public/scores/$match->id/$match->localTeamIdName-$match->guestTeamIdName-0001.jpg"));
    }
}
