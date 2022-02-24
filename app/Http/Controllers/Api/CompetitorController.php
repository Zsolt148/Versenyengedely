<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Competitor::query()
            ->registered()
            ->with('team')
            ->get(['id', 'name', 'birth', 'teams_id', 'created_at'])
            ->map(fn (Competitor $competitor) => [
                'id' => $competitor->id,
                'name' => $competitor->name,
                'birth' => $competitor->birth,
                'sex' => $competitor->sex,
                'team_id' => $competitor->teams_id,
                'team_sa' => $competitor->team->SA,
                'created_at' => $competitor->created_at
            ])
            ->toArray();
    }
}
