<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model|mixed
     */
    public static function getActiveGame()
    {
        $activeGame = self::whereActive(1)->first();
        return $activeGame ?? self::factory()->create();

    }
}
