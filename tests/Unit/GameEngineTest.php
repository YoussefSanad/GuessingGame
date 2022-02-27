<?php

namespace Tests\Unit;

use App\Enums\NumberAssessmentValue;
use App\Operations\GameEngine;
use PHPUnit\Framework\TestCase;

class GameEngineTest extends TestCase
{

    public function test_assessNumber_whenGivenNumberIsLessThanTargetNumber_returnsLow()
    {
        $targetNumber = 10;
        $givenNumber = 5;

        $output = GameEngine::assessNumber($givenNumber, $targetNumber);

        $this->assertEquals(NumberAssessmentValue::LOW, $output);
    }

    public function test_assessNumber_whenGivenNumberIsHigherThanTargetNumber_returnsHigh()
    {
        $targetNumber = 1;
        $givenNumber = 5;

        $output = GameEngine::assessNumber($givenNumber, $targetNumber);

        $this->assertEquals(NumberAssessmentValue::HIGH, $output);
    }

    public function test_assessNumber_whenGivenNumberIsMatchingTargetNumber_returnsMatching()
    {
        $targetNumber = 5;
        $givenNumber = 5;

        $output = GameEngine::assessNumber($givenNumber, $targetNumber);

        $this->assertEquals(NumberAssessmentValue::MATCH, $output);
    }

    public function test_message_onReturnedEnums()
    {
        $targetNumber = 5;
        $givenNumber = 5;

        $match = GameEngine::assessNumber($givenNumber, $targetNumber);
        $higher = GameEngine::assessNumber($givenNumber + 1, $targetNumber);
        $lower = GameEngine::assessNumber($givenNumber - 1, $targetNumber);

        $this->assertEquals(NumberAssessmentValue::MATCH->message(), $match->message());
        $this->assertEquals(NumberAssessmentValue::HIGH->message(), $higher->message());
        $this->assertEquals(NumberAssessmentValue::LOW->message(), $lower->message());

    }

    public function test_isCorrectGuess_onReturnedEnums()
    {
        $targetNumber = 5;
        $givenNumber = 5;

        $match = GameEngine::assessNumber($givenNumber, $targetNumber);
        $higher = GameEngine::assessNumber($givenNumber + 1, $targetNumber);
        $lower = GameEngine::assessNumber($givenNumber - 1, $targetNumber);

        $this->assertTrue($match->isCorrectGuess());
        $this->assertFalse($higher->isCorrectGuess());
        $this->assertFalse($lower->isCorrectGuess());

    }
}
