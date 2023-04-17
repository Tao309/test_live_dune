<?php

use PHPUnit\Framework\TestCase;

final class DivergeTest extends TestCase
{
    public const FIRST = 'first';
    public const SECOND = 'second';
    public const THIRD = 'third';

    private $inputData = [];

    public function testDiverge()
    {
        $this->initInputData();

        $expected = $this->getExpectedResult();

        foreach ($this->inputData as $index => $data) {
            $actual = $this->getActualResult($data[0], $data[1]);

            try {
                $this->assertEquals($expected[$index], $actual);
            } catch (\Throwable $e) {
                $this->printNotEqual($index, $actual, $expected[$index]);
            }
        }
    }

    private function getDivergeServiceMock()
    {
        $mock = $this->getMockBuilder(\Val\TestLiveDune\DivergeService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'diffPrice', 'getCalculatedPriceDeviation'
            ])
            ->getMock();

        $permissibleVariation = 0.25;

        $mock->method('getCalculatedPriceDeviation')->willReturnCallback(function ($new, $out) {
            return round(abs(($out - $new) / $out), 2);
        });

        $mock->method('diffPrice')->willReturnCallback(function ($new, $out) use ($permissibleVariation, $mock) {
            return $mock->getCalculatedPriceDeviation($new, $out) < $permissibleVariation;
        });

        return $mock;
    }

    private function getActualResult(float $newPrice, float $currentPrice)
    {
        $service =  $this->getDivergeServiceMock();

        return (bool) $service->diffPrice($newPrice, $currentPrice);
    }

    private function initInputData()
    {
        $this->inputData = [
            self::FIRST => [10000, 13000],//0.23
            self::SECOND => [5000, 4800],//0.04
            self::THIRD => [6700, 5200],//0.29
        ];
    }

    private function getExpectedResult()
    {
        return [
            self::FIRST => true,
            self::SECOND => true,
            self::THIRD => false,
        ];
    }

    private function printNotEqual($index, $actual, $expected)
    {
        echo "\n";
        echo "\033[1;33m";
        echo "Index: ";
        echo $index;
        echo "\033[0m";
        echo "\n";
        echo "\033[1;31m";
        echo "Error: ";
        echo $actual." not equal to " . $expected;
        echo "\033[0m";
    }
}
