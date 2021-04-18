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
        $team = $row[4];

        $team_id = null;
        if (Team::where('name', 'like', '%' . $team . '%')->get()->isNotEmpty()) { //ha van egyesület

            if(Carbon::createFromFormat('Y', $birth)->diffInYears(Carbon::now()) >= 25) { //ha tobb mint 25
                $team_id = Team::where('name', 'like', '%' . $team . '%')->first()->id;
                return Competitor::updateOrCreate(
                    ['federal_reg_code' => $fed_reg],
                    [
                        'team_reg_code' => $team_reg,
                        'name' => $name,
                        'birth' => $birth,
                        'teams_id' => $team_id,
                    ]
                );
            }else {
                Log::info('Under 25 years: ' . $fed_reg . ' - ' . $name . ' - ' . $birth . ' - ' . $team);
                $this->youngComps->push(
                    ['federal_reg_code' => $fed_reg, 'name' => $name, 'birth' => $birth, 'team' => $team]
                );
            }
        }else {
            Log::debug('Missing competitor: ' . $fed_reg . ' - ' . $name .  ' - ' . $birth . ' - ' . $team);
            $this->missingComps->push(
                ['federal_reg_code' => $fed_reg, 'name' => $name, 'birth' => $birth, 'team' => $team]
            );
        }
    }

    public function getYoungComps() {
        return $this->youngComps;
    }

    public function getMissingComps() {
        return $this->missingComps;
    }
}
