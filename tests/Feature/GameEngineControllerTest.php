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

    public function test_guess_whenPassingNonExistingUserID()
    {
        $randomUserId = 5;
        $this->url = sprintf("/api/games/%d/users/%d/guess", $this->game->id, $randomUserId);

        $response = $this->post($this->url, ['guess' => $this->game->target_number + 1]);

        $response->assertStatus(404);
    }

    public function test_guess_existsAndBroadcastsMessageNotificationEventWhenNotMatched()
    {
        Event::fake();
        $this->post($this->url, ['guess' => $this->game->target_number + 1]);
        $this->post($this->url, ['guess' => $this->game->target_number - 1]);
        Event::assertDispatched(MessageNotification::class, 2);
    }

    public function test_guess_existsAndBroadcastsMessageNotificationEventWhenMatched()
    {
        Event::fake();
        $response = $this->post($this->url, ['guess' => $this->game->target_number]);

        $response->assertStatus(200);
        Event::assertDispatched(MessageNotification::class);
    }

    public function test_guess_closesTheGameWhenMatched()
    {
        $response = $this->post($this->url, ['guess' => $this->game->target_number]);
        $this->game->refresh();

        $response->assertStatus(200);
        $this->assertFalse((bool)$this->game->active);

    }

    public function test_guess_validation()
    {
        $randomString = 'random-string';
        $numberLessThanOne = 0;
        $numberMoreThanOneHundred = 100;
        $validNumber = 50;

        $response = $this->post($this->url, ['guess' => $validNumber]);
        $response->assertSessionHasNoErrors();

        $response = $this->post($this->url, ['guess' => $randomString]);
        $response->assertSessionHasErrors(['guess']);

        $response = $this->post($this->url, ['guess' => $numberLessThanOne]);
        $response->assertSessionHasErrors(['guess']);

        $response = $this->post($this->url, ['guess' => $numberMoreThanOneHundred]);
        $response->assertSessionHasErrors(['guess']);
    }

}
