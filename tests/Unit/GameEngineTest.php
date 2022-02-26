<?php

namespace Tests\Unit;

use App\Enums\NumberAssesmentValue;
use App\Operations\GameEngine;
use PHPUnit\Framework\TestCase;

class GameEngineTest extends TestCase
{

    public function test_assessNumber_whenGivenNumberIsLessThanTargetNumber_returnsLow()
    {
        $targetNumber = 10;
        $givenNumber = 5;

        $output = GameEngine::assessNumber($givenNumber, $targetNumber);

        $this->assertEquals(NumberAssesmentValue::LOW, $output);
    }

    public function test_assessNumber_whenGivenNumberIsHigherThanTargetNumber_returnsHigh()
    {
        $targetNumber = 1;
        $givenNumber = 5;

        $output = GameEngine::assessNumber($givenNumber, $targetNumber);

        $this->assertEquals(NumberAssesmentValue::HIGH, $output);
    }

    public function test_assessNumber_whenGivenNumberIsMatchingTargetNumber_returnsMatching()
    {
        $targetNumber = 5;
        $givenNumber = 5;

        $output = GameEngine::assessNumber($givenNumber, $targetNumber);

        $this->assertEquals(NumberAssesmentValue::MATCH, $output);
    }
}
