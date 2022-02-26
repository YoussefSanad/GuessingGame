<?php

namespace App\Operations;

use App\Enums\NumberAssesmentValue;

class GameEngine
{


    /**
     * @param int $number
     * @param int $targetNumber
     * @return NumberAssesmentValue
     */
    public static function assessNumber(int $number, int $targetNumber): NumberAssesmentValue
    {
        if ($number < $targetNumber) return NumberAssesmentValue::LOW;
        if ($number > $targetNumber) return NumberAssesmentValue::HIGH;
        return NumberAssesmentValue::MATCH;
    }

}
