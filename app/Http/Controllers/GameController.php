<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{

    /**
     * Returns teh game_screen view with current active game.
     * @return mixed
     */
    public function showGame()
    {
        return view('games.show')->withActiveGame(Game::getActiveGame());
    }

}
