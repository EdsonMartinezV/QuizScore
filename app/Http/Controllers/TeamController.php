<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Ilovepdf\Ilovepdf;
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

    public function download(Request $request) {
        Gate::authorize('download', Team::class);

        $pdf = Pdf::loadView('teams.scoreBoard', [
            'teams' => Team::orderBy('won_matches', 'desc')->orderBy('scored_points', 'desc')->orderBy('point_spread', 'desc')->get(),
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

        $pdf->save("public/score_board/score_board.pdf", 'local');

        $love = new Ilovepdf('project_public_60fe87a68f6813853d3595269322bb07_b_sBzedffdb57573e29748a8e0fae2fd4d3ef', 'secret_key_d875f8437e476cc15641885cbcaebc3f_RCqMXb54821ac7b6bb0d313394157517a9dd8');
        $task = $love->newTask('pdfjpg');
        $file = $task->addFile(storage_path("app/public/score_board/score_board.pdf"));
        $task->execute();
        $task->download(storage_path("app/public/score_board"));

        return response()->download(storage_path("app/public/score_board/score_board-0001.jpg"));
    }
}
