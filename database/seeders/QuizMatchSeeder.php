<?php

namespace Database\Seeders;

use App\Models\QuizMatch;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void{
        $teams = [];
        foreach (Team::all() as $team) {
            $teams[$team->identifier_name] = $team;
        }

        QuizMatch::create([
            'local_team_id' => $teams['oriente']->id,
            'guest_team_id' => $teams['oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noreste']->id,
            'guest_team_id' => $teams['norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['occidente']->id,
            'guest_team_id' => $teams['noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_sierra']->id,
            'guest_team_id' => $teams['sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noreste']->id,
            'guest_team_id' => $teams['sur_pacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca_norponiente']->id,
            'guest_team_id' => $teams['centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_sierra']->id,
            'guest_team_id' => $teams['norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca_norponiente']->id,
            'guest_team_id' => $teams['noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['occidente']->id,
            'guest_team_id' => $teams['oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['centro']->id,
            'guest_team_id' => $teams['sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['occidente']->id,
            'guest_team_id' => $teams['oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_sierra']->id,
            'guest_team_id' => $teams['sur_pacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca_norponiente']->id,
            'guest_team_id' => $teams['oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['sur_pacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['centro']->id,
            'guest_team_id' => $teams['norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur']->id,
            'guest_team_id' => $teams['noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_sierra']->id,
            'guest_team_id' => $teams['noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca_norponiente']->id,
            'guest_team_id' => $teams['oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['centro']->id,
            'guest_team_id' => $teams['sur_pacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur']->id,
            'guest_team_id' => $teams['oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noroccidental']->id,
            'guest_team_id' => $teams['norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['centro']->id,
            'guest_team_id' => $teams['sur_sierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur']->id,
            'guest_team_id' => $teams['occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['oaxaca_norponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noroccidental']->id,
            'guest_team_id' => $teams['noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca']->id,
            'guest_team_id' => $teams['sur_pacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['norte']->id,
            'guest_team_id' => $teams['oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur']->id,
            'guest_team_id' => $teams['oaxaca_norponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noroccidental']->id,
            'guest_team_id' => $teams['sur_sierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['norte']->id,
            'guest_team_id' => $teams['occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca']->id,
            'guest_team_id' => $teams['noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_pacifico']->id,
            'guest_team_id' => $teams['oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noroccidental']->id,
            'guest_team_id' => $teams['centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['norte']->id,
            'guest_team_id' => $teams['oaxaca_norponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_pacifico']->id,
            'guest_team_id' => $teams['occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oriente']->id,
            'guest_team_id' => $teams['noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca']->id,
            'guest_team_id' => $teams['sur_sierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['norte']->id,
            'guest_team_id' => $teams['sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca']->id,
            'guest_team_id' => $teams['centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_pacifico']->id,
            'guest_team_id' => $teams['oaxaca_norponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oriente']->id,
            'guest_team_id' => $teams['sur_sierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noreste']->id,
            'guest_team_id' => $teams['occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oriente']->id,
            'guest_team_id' => $teams['centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_pacifico']->id,
            'guest_team_id' => $teams['sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca']->id,
            'guest_team_id' => $teams['noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noreste']->id,
            'guest_team_id' => $teams['oaxaca_norponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['occidente']->id,
            'guest_team_id' => $teams['sur_sierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noreste']->id,
            'guest_team_id' => $teams['sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_pacifico']->id,
            'guest_team_id' => $teams['norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oriente']->id,
            'guest_team_id' => $teams['noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['occidente']->id,
            'guest_team_id' => $teams['centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_sierra']->id,
            'guest_team_id' => $teams['oaxaca_norponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['centro']->id,
            'guest_team_id' => $teams['noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['norte']->id,
            'guest_team_id' => $teams['oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['noroccidental']->id,
            'guest_team_id' => $teams['sur_pacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur']->id,
            'guest_team_id' => $teams['oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['oaxaca_norponiente']->id,
            'guest_team_id' => $teams['occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['sur_fronterizo']->id,
            'guest_team_id' => $teams['sur_sierra']->id
        ]);
    }
}
