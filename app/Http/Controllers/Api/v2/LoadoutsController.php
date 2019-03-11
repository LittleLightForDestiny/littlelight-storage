<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Loadout;
use Illuminate\Support\Facades\Input;


class LoadoutsController extends ApiV2Controller
{
  public function list(Request $request)
  {
    $auth = $this->login($request);
    $player = $auth->player;
    return Response::json(["data" => $player->loadouts, "secret" => $auth->secret]);
  }

  public function save(Request $request){
    $auth = $this->login($request);
    $player = $auth->player;
    $assigned_id = Input::post('assignedId');
    if($assigned_id == null || strlen($assigned_id) == 0){
      return Response::json(["result"=>0]);
    }
    $name = Input::post('name');
    $emblem_hash = Input::post('emblemHash');
    $equipped = Input::post("equipped");
    $unequipped = Input::post("unequipped");
    
    $loadout = Loadout::updateOrCreate([
      "assignedId"=>$assigned_id,
      "player_id"=>$player->id
		  ],[
			"name"=>$name,
			"emblemHash"=>$emblem_hash,
			"equipped"=>$equipped,
			"unequipped"=>$unequipped
    ]);
    $loadout->save();
    $player->loadouts()->save($loadout);
    return Response::json(["result"=>1]);
  }

  public function delete(Request $request){
    $auth = $this->login($request);
    $player = $auth->player;
    $assigned_id = Input::post('assignedId');
    if($assigned_id == null || strlen($assigned_id) == 0){
      return Response::json(["result"=>0]);
    }
    
    Loadout::where([
      "assignedId"=>$assigned_id,
      "player_id"=>$player->id
    ])->delete();
    
    return Response::json(["result"=>1]);
  }
}
