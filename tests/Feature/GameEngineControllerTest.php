<?php

namespace Tests\Feature;

use App\Events\MessageNotification;
use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class GameEngineControllerTest extends TestCase
{
    use RefreshDatabase;

    private Game   $game;
    private User   $user;
    private string $url;

    protected function setUp(): void
    {
        parent::setUp();
        $this->game = Game::factory()->create();
        $this->user = User::factory()->create();
        $this->url = sprintf("/api/games/%d/users/%d/guess", $this->game->id, $this->user->id);
    }

    public function test_guess_whenPassingNonExistingUserID_returnsNotFoundStatus()
    {
        $randomUserId = 5;
        $this->url = sprintf("/api/games/%d/users/%d/guess", $this->game->id, $randomUserId);

        $response = $this->post($this->url, ['guess' => $this->game->target_number + 1]);

        $response->assertStatus(404);
    }


    public function test_guess_whenCalledWithValidUserAndValidGameId_returnsSuccessStatus()
    {
        $response = $this->post($this->url, ['guess' => $this->game->target_number]);
        $response->assertStatus(200);
    }

    public function test_guess_whenGuessIsNotMatched_broadcastsMessageNotificationEvent()
    {
        Event::fake();
        $this->post($this->url, ['guess' => $this->game->target_number + 1]);
        Event::assertDispatched(MessageNotification::class, 1);

        $this->post($this->url, ['guess' => $this->game->target_number - 1]);
        Event::assertDispatched(MessageNotification::class, 2);
    }

    public function test_guess_whenGuessIsMatched_broadcastsMessageNotificationEvent()
    {
        Event::fake();
        $response = $this->post($this->url, ['guess' => $this->game->target_number]);

        $response->assertStatus(200);
        Event::assertDispatched(MessageNotification::class, 1);
    }

    public function test_guess_whenPassingTheCorrectGuess_setsTheGameAsInactive()
    {
        $this->post($this->url, ['guess' => $this->game->target_number]);
        $this->game->refresh();

        $this->assertFalse((bool)$this->game->active);
    }

    public function test_guess_whenGuessNumberIsLessThanOne_hasValidationError()
    {
        $numberLessThanOne = 0;
        $response = $this->post($this->url, ['guess' => $numberLessThanOne]);

        $response->assertSessionHasErrors(['guess']);
    }

    public function test_guess_whenGuessNumberIsMoreThanOneHundred_hasValidationError()
    {
        $numberMoreThanOneHundred = 101;
        $response = $this->post($this->url, ['guess' => $numberMoreThanOneHundred]);

        $response->assertSessionHasErrors(['guess']);
    }

    public function test_guess_whenGuessNumberIsNotNumeric_hasValidationError()
    {
        $randomString = 'random-string';

        $response = $this->post($this->url, ['guess' => $randomString]);
        $response->assertSessionHasErrors(['guess']);
    }

    public function test_guess_whenGuessNumberIsNumericAndBetweenOneAndOneHundred_hasNoValidationError()
    {
        $validNumber = 50;
        $response = $this->post($this->url, ['guess' => $validNumber]);

        $response->assertSessionHasNoErrors();
    }

}
