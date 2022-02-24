<?php

namespace App\Imports;

use App\Models\Competitor;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class CompetitorImport implements ToModel
{
    private $missingComps;
    private $youngComps;

    public function __construct() {
        $this->missingComps = collect();
        $this->youngComps = collect();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        $fed_reg = $row[0];
        $team_reg = $row[1];
        $name = $row[2];
        $birth = $row[3];
        $sex = $row[4];
        $team = $row[5];

        $team_id = null;

        if (Team::where('name', 'like', '%' . $team . '%')->get()->isEmpty()) {

            Log::debug('Missing competitors team: ' . $fed_reg . ' - ' . $name .  ' - ' . $birth . ' - ' . $team);
            $this->missingComps->push(
                ['federal_reg_code' => $fed_reg, 'name' => $name, 'birth' => $birth, 'team' => $team]
            );

            return null;
        }

        if(Carbon::createFromFormat('Y', $birth)->diffInYears(Carbon::now()) < 25) {

            Log::info('Under 25 years: ' . $fed_reg . ' - ' . $name . ' - ' . $birth . ' - ' . $team);
            $this->youngComps->push(
                ['federal_reg_code' => $fed_reg, 'name' => $name, 'birth' => $birth, 'team' => $team]
            );

            return null;
        }

        $team_id = Team::where('name', 'like', '%' . $team . '%')->first()->id;

        return Competitor::updateOrCreate(
            ['federal_reg_code' => $fed_reg],
            [
                'is_registered' => true,
                'team_reg_code' => $team_reg,
                'name' => $name,
                'birth' => $birth,
                'sex' => $sex,
                'teams_id' => $team_id,
            ]
        );
    }

    public function getYoungComps() {
        return $this->youngComps;
    }

    public function getMissingComps() {
        return $this->missingComps;
    }
}
