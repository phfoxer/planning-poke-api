<?php
namespace App\Modules\General\MatchPlayer\Repositories;
use App\Modules\General\MatchPlayer\Models\MatchPlayer;
use App\Modules\General\MatchPlayer\Repositories\MatchPlayerSearchRepository;
use Validator;
use Illuminate\Http\Request;

class MatchPlayerRepository
{
    private $matchplayerSearchRepository;
    function __construct(MatchPlayerSearchRepository $matchplayerSearchRepository){
        $this->matchplayerSearchRepository = $matchplayerSearchRepository;
    }

    public function index(Request $request){
        return $this->matchplayerSearchRepository->search(MatchPlayer::with(["match"]), $request);
    }

    public function show($id){
    	return MatchPlayer::where(["id"=>$id])->first();
    }

    public function store($request){
        $data = [
        "match_id" => $request->match_id,
        "name" => $request->name,
        "value" => $request->value,
        ];
        return MatchPlayer::create($data);
    }

    public function update($request, $id){
        $validator = Validator::make($request->all(), [
            "match_id"=>"nullable",
            "name"=>"nullable",
            "value"=>"nullable",
        ]);
        if($validator->fails()){
            throw new \Exception("invalid_fields",400);
        } else {
            $data = [
            "match_id"=>$request->match_id,
            "name"=>$request->name,
            "value"=>$request->value,
            ];
            return MatchPlayer::where(["id"=>$id])->update($data);
        }
    }

    public function destroy($id){
    	return MatchPlayer::where(["id"=>$id])->delete();
    }

}