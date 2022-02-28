<?php

namespace App\Http\Api;

use App\Events\MessageNotification;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use App\Operations\GameEngine;
use Illuminate\Http\Request;

class GameEngineController extends Controller
{

    /**
     * @param Game    $game
     * @param User    $user
     * @param Request $request
     * @return void
     */
    public function guess(Game $game, User $user, Request $request)
    {
        if (!$game->active)
        {
            event(new MessageNotification('Game Finished', $user->id, 0));
        }
        else
        {
            $this->validateInput($request);
            $assessment = GameEngine::assessNumber($request->guess, $game->target_number);
            if ($assessment->isCorrectGuess()) $game->closeGame();
            event(new MessageNotification($assessment->message(), $user->id, $assessment->isCorrectGuess()));
        }
    }


    /**
     * Validates the user input
     * @param Request $request
     */
    private function validateInput(Request $request)
    {
        $request->validate([
            'guess' => 'required|numeric|min:1|max:100',
        ]);
    }


}
