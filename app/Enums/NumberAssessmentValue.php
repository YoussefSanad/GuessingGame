<?php

namespace App\Enums;

enum NumberAssessmentValue
{
    case LOW;
    case HIGH;
    case MATCH;

    /**
     * returns the message associated with each case.
     * @return string
     */
    public function message(): string
    {
        return match ($this)
        {
            self::LOW   => "Go Higher",
            self::HIGH  => "Go Lower",
            self::MATCH => "You Win!"
        };
    }

    /**
     * returns returns true if the case is Match .. false otherwise
     * @return bool
     */
    public function isCorrectGuess(): bool
    {
        return match ($this)
        {
            self::LOW, self::HIGH => false,
            self::MATCH           => true
        };
    }


}
