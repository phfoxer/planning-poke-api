<?php
namespace App\Modules\General\MatchPlayer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\General\MatchPlayer\Repositories\MatchPlayerRepository;

class MatchPlayerController extends Controller
{
    private $matchplayerRepository;

    function __construct(MatchPlayerRepository $matchplayerRepository ){
        $this->matchplayerRepository = $matchplayerRepository;
    }

    public function index(Request $request){
        try {
            $data =  $this->matchplayerRepository->index($request);
            return response()->json($data, 200);
        } catch(\Exception $e){
            $data = [
                "message"=> "Error, try again!",
                "text"=>    $e->getMessage()
            ];
            return response()->json($data, 401);
        }
    }

    public function show($id){
        try {
            $data = $this->matchplayerRepository->show($id);
            return response()->json($data, 200);
        } catch(\Exception $e){
            $data = [
                "message"=> "Error, try again!",
                "text"=>    $e->getMessage()
            ];
            return response()->json($data, 400);
        }
    }

    public function store(Request $request){
        try {
            $data = $this->matchplayerRepository->store($request);
            return response()->json($data, 200);
        } catch(\Exception $e){
            $data = [
                "message "=> "Error, try again!",
                "code" => $e->getCode(),
                "text "=>    $e->getMessage()
            ];
            return response()->json($data, ($e->getCode()==0) ? 400 : $e->getCode());
        }
    }

    public function update(Request $request, $id){
        try {
            $data = $this->matchplayerRepository->update($request, $id);
            return response()->json($data, 200);
        } catch(\Exception $e){
            $data = [
                "message" => "Error, try again!",
                 "code" => $e->getCode(),
                "text" =>    $e->getMessage()
            ];
            return response()->json($data, ($e->getCode()==0) ? 400 : $e->getCode());
        }
    }

    public function destroy($id){
        try {
            $data = $this->matchplayerRepository->destroy($id);
            return response()->json($data, 200);
        } catch(\Exception $e){
            $data = [
                "message"=> "Error, try again!",
                "text"=>    $e->getMessage()
            ];
            return response()->json($data, 400);
        }
    }

}