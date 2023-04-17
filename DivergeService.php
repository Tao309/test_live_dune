<?php

class DivergeService implements DivergeInterface
{
    private int $permissibleVariation = 0;

    private float $deviation = 0;

    /**
     * @inheritDoc
     */
    public function diffPrice(float $new, float $out): bool
    {
        $diff = $this->getCalculatePriceDifference($new, $out);


        //
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDeviation(): float
    {
        return $this->deviation;
    }

    /**
     * @param float $deviation
     * @return void
     */
    private function setDeviation(float $deviation): void
    {
        $this->deviation = $deviation;
    }

    private function getCalculatePriceDifference(float $new, float $out)
    {


    }
}