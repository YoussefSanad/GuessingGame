<?php

use App\Events\MessageNotification;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel(MessageNotification::CHANNEL_NAME, function (User $user) {
    return ['id' => $user->id, 'name' => $user->name];
});
