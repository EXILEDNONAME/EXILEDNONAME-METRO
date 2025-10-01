<?php

namespace App\Traits\Backend\__System\Widgets;

use App\Models\Backend\__System\Games;
use App\Models\Backend\__System\GamesDetails;
use Redirect, Response;

trait GameController {

  /**
  **************************************************
  * @return GAMES_DETAILS
  **************************************************
  **/

  public function games_details() {
    $data = GamesDetails::get();
    return Response::json($data);
  }

  /**
  **************************************************
  * @return GAMES_UPDATE
  **************************************************
  **/

  public function games_update($id) {
    $user = Games::where('id_user', $id)->first();
    if(!empty($user)) {
      $data = Games::where('id_user', $id)->update(['score' => $user->score + 1]);
      return response()->json(['status' => 'success', 'score' => $user->score + 1]);
    }
    else {
      $data = Games::create(['id_user' => $id, 'score' => 1 ]);
      return response()->json(['status' => 'success', 'score'  => 1]);
    }
  }

  /**
  **************************************************
  * @return GAMES_SCORE
  **************************************************
  **/

  public function games_score() {
    return $data = Games::get();
  }
}
