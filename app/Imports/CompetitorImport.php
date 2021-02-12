<?php

namespace App\Imports;

use App\Models\Competitor;
use App\Models\Team;
use Maatwebsite\Excel\Concerns\ToModel;

class CompetitorImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        $fed_reg = $row[0];
        $team_reg = $row[1];
        $name = $row[2];
        $b = $row[3];
        $team = $row[4];

        $team_id = null;
        if (Team::where('name', 'like', '%' . $team . '%')->get()->isNotEmpty()) { //ha van egyesület
            $team_id = Team::where('name', 'like', '%' . $team . '%')->first()->id;
            return Competitor::updateOrCreate(
                ['federal_reg_code' => $fed_reg],
                [
                    'team_reg_code' => $team_reg,
                    'name' => $name,
                    'birth' => $b,
                    'teams_id' => $team_id,
                ]
            );
        }else {
            return null;
        }
    }
}
