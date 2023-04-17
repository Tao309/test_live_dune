<?php

namespace Val\TestLiveDune;

class DivergeService implements DivergeInterface
{
    private float $permissibleVariation = 0.25;

    private float $deviation = 0;

    /**
     * @inheritDoc
     */
    public function diffPrice(float $new, float $out): bool
    {
        $this->setDeviation($this->getCalculatedPriceDeviation($new, $out));

        return $this->getDeviation() < $this->getPermissibleVariation();
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

    /**
     * @return float
     */
    private function getPermissibleVariation(): float
    {
        return $this->permissibleVariation;
    }

    /**
     * @param float $permissibleVariation
     * @return void
     */
    private function setPermissibleVariation(float $permissibleVariation): void
    {
        $this->permissibleVariation = $permissibleVariation;
    }

    /**
     * @param float $new
     * @param float $out
     * @return float
     */
    public function getCalculatedPriceDeviation(float $new, float $out): float
    {
        return round(abs(($out - $new) / $out));
    }
}
