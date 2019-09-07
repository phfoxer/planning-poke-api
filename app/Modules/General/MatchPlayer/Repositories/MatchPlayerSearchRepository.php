<?php
namespace App\Modules\General\MatchPlayer\Repositories;
use App\Modules\General\MatchPlayer\Models\MatchPlayer;

use Illuminate\Http\Request;

class MatchPlayerSearchRepository
{
    public function search($queryBuilder, $request){

    if ($request->id) {
        $queryBuilder->where("id","=",$request->id);
    }

    if ($request->match_id) {
        $queryBuilder->where("match_id","=",$request->match_id);
    }

    if ($request->name) {
        $queryBuilder->where("name","=",$request->name);
    }

    if ($request->value) {
        $queryBuilder->where("value","=",$request->value);
    }

        return $queryBuilder->paginate(($request->count) ? $request->count : 20);
    }
}