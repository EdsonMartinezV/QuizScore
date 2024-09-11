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
            'local_team_id' => $teams['Oriente']->id,
            'guest_team_id' => $teams['Oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noreste']->id,
            'guest_team_id' => $teams['Norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Occidente']->id,
            'guest_team_id' => $teams['Noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurSierra']->id,
            'guest_team_id' => $teams['Sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noreste']->id,
            'guest_team_id' => $teams['SurPacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['OaxacaNorponiente']->id,
            'guest_team_id' => $teams['Centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurSierra']->id,
            'guest_team_id' => $teams['Norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['OaxacaNorponiente']->id,
            'guest_team_id' => $teams['Noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Occidente']->id,
            'guest_team_id' => $teams['Oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Centro']->id,
            'guest_team_id' => $teams['Sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Occidente']->id,
            'guest_team_id' => $teams['Oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurSierra']->id,
            'guest_team_id' => $teams['SurPacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['OaxacaNorponiente']->id,
            'guest_team_id' => $teams['Oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['SurPacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Centro']->id,
            'guest_team_id' => $teams['Norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Sur']->id,
            'guest_team_id' => $teams['Noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurSierra']->id,
            'guest_team_id' => $teams['Noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['OaxacaNorponiente']->id,
            'guest_team_id' => $teams['Oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Centro']->id,
            'guest_team_id' => $teams['SurPacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Sur']->id,
            'guest_team_id' => $teams['Oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noroccidental']->id,
            'guest_team_id' => $teams['Norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Centro']->id,
            'guest_team_id' => $teams['SurSierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Sur']->id,
            'guest_team_id' => $teams['Occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['OaxacaNorponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noroccidental']->id,
            'guest_team_id' => $teams['Noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oaxaca']->id,
            'guest_team_id' => $teams['SurPacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Norte']->id,
            'guest_team_id' => $teams['Oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Sur']->id,
            'guest_team_id' => $teams['OaxacaNorponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noroccidental']->id,
            'guest_team_id' => $teams['SurSierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Norte']->id,
            'guest_team_id' => $teams['Occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oaxaca']->id,
            'guest_team_id' => $teams['Noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurPacifico']->id,
            'guest_team_id' => $teams['Oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noroccidental']->id,
            'guest_team_id' => $teams['Centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Norte']->id,
            'guest_team_id' => $teams['OaxacaNorponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurPacifico']->id,
            'guest_team_id' => $teams['Occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oriente']->id,
            'guest_team_id' => $teams['Noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oaxaca']->id,
            'guest_team_id' => $teams['SurSierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Norte']->id,
            'guest_team_id' => $teams['Sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oaxaca']->id,
            'guest_team_id' => $teams['Centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurPacifico']->id,
            'guest_team_id' => $teams['OaxacaNorponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oriente']->id,
            'guest_team_id' => $teams['SurSierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noreste']->id,
            'guest_team_id' => $teams['Occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oriente']->id,
            'guest_team_id' => $teams['Centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurPacifico']->id,
            'guest_team_id' => $teams['Sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oaxaca']->id,
            'guest_team_id' => $teams['Noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noreste']->id,
            'guest_team_id' => $teams['OaxacaNorponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Occidente']->id,
            'guest_team_id' => $teams['SurSierra']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noreste']->id,
            'guest_team_id' => $teams['Sur']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurPacifico']->id,
            'guest_team_id' => $teams['Norte']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['Oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Oriente']->id,
            'guest_team_id' => $teams['Noroccidental']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Occidente']->id,
            'guest_team_id' => $teams['Centro']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurSierra']->id,
            'guest_team_id' => $teams['OaxacaNorponiente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Centro']->id,
            'guest_team_id' => $teams['Noreste']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Norte']->id,
            'guest_team_id' => $teams['Oaxaca']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Noroccidental']->id,
            'guest_team_id' => $teams['SurPacifico']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['Sur']->id,
            'guest_team_id' => $teams['Oriente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['OaxacaNorponiente']->id,
            'guest_team_id' => $teams['Occidente']->id
        ]);

        QuizMatch::create([
            'local_team_id' => $teams['SurFronterizo']->id,
            'guest_team_id' => $teams['SurSierra']->id
        ]);
    }
}
