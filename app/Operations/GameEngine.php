<?php

namespace App\Operations;

use App\Enums\NumberAssessmentValue;

class GameEngine
{


    /**
     * @param int $number
     * @param int $targetNumber
     * @return NumberAssessmentValue
     */
    public static function assessNumber(int $number, int $targetNumber): NumberAssessmentValue
    {
        if ($number < $targetNumber) return NumberAssessmentValue::LOW;
        if ($number > $targetNumber) return NumberAssessmentValue::HIGH;
        return NumberAssessmentValue::MATCH;
    }

}
