<?php

namespace Tests\Unit;

use App\Enums\NumberAssessmentValue;
use App\Operations\GameEngine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class GameEngineTest extends TestCase
{
    use RefreshDatabase;

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

}
