<?php
namespace App\Modules\General\Match\Repositories;
use App\Modules\General\Match\Models\Match;

use Illuminate\Http\Request;

class MatchSearchRepository
{
    public function search($queryBuilder, $request){

    if ($request->id) {
        $queryBuilder->where("id","=",$request->id);
    }

    if ($request->code) {
        $queryBuilder->where("code","=",$request->code);
    }

        return $queryBuilder->paginate(($request->count) ? $request->count : 20);
    }
}