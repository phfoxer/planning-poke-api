<?php
namespace App\Modules\General\Match\Repositories;
use App\Modules\General\Match\Models\Match;
use App\Modules\General\Match\Repositories\MatchSearchRepository;
use App\Modules\General\MatchPlayer\Repositories\MatchPlayerRepository;
use Validator;
use Illuminate\Http\Request;
use App\Modules\General\MatchPlayer\Models\MatchPlayer;

class MatchRepository
{
    private $matchSearchRepository;
    private $matchPlayerRepository;
    function __construct(MatchSearchRepository $matchSearchRepository, MatchPlayerRepository $matchPlayerRepository){
        $this->matchSearchRepository = $matchSearchRepository;
        $this->matchPlayerRepository = $matchPlayerRepository;
    }

    public function index(Request $request){
        return $this->matchSearchRepository->search(Match::with(['players']), $request);
    }

    public function show($code){
    	return Match::with(['players'])->where(["code"=>$code])->first();
    }

    public function store($request){
        $matchPlayer = new Request();
        $validator = Validator::make($request->all(), [
            "code" => "required",
            "name" => "required",
            "value" => "required"
        ]);
        if($validator->fails()){
            throw new \Exception("invalid_fields",400);
        } else {
            $data = [
                "code"=>$request->code,
            ];
            //
            $match = Match::where(["code"=>$request->code])->first();
            if(!$match){
                $match = Match::create($data);
            }
            //
            $player = MatchPlayer::where([
                "match_id" => $match->id,
                "name"=>$request->name
            ])->first();
            //
            $matchPlayer = [
                "match_id" => $match->id,
                "name" => $request->name,
                "value" =>  $request->value
            ];
            //
            if (!$player) {
                MatchPlayer::create($matchPlayer);
                return $match;
            } else {
                MatchPlayer::where([
                    "match_id" => $match->id,
                    "id"=>$player->id
                ])->update($matchPlayer);
            }
        }
        
    }

    public function update($request, $id){
        $validator = Validator::make($request->all(), [
            "code"=>"nullable",
        ]);
        if($validator->fails()){
            throw new \Exception("invalid_fields",400);
        } else {
            $data = [
            "code"=>$request->code,
            ];
            return Match::where(["id"=>$id])->update($data);
        }
    }

    public function destroy($code){
        $match = Match::where(["code"=>$code])->first();
        if ($match) {
            // Match::where(["id"=>$match->id])->delete();
            MatchPlayer::where(["match_id"=>$match->id])->delete();
        }
    }

}