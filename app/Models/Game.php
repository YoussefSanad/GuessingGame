<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed target_number
 */
class Game extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public static function getActiveGame(): mixed
    {
        $activeGame = self::whereActive(1)->first();
        return $activeGame ?? self::create(['target_number' => rand(1, 100), 'active' => 1,]);
    }


    /**
     * Sets the game as inactive,
     */
    public function closeGame()
    {
        $this->update(['active' => false]);
    }

}
