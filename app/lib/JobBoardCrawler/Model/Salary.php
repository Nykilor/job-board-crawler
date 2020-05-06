<?php


namespace JobBoardCrawler\Model;



class Salary
{
    /**
     * @var float
     */
    private $min;

    /**
     * @var float
     */
    private $max;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string hour/day/month
     */
    private $rate;

    /**
     * @var string[]
     */
    private $allowedRates = ["hour", "day", "month", "year"];

    /**
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * @param float $min
     */
    public function setMin(float $min): void
    {
        $this->min = $min;
    }

    /**
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * @param float $max
     */
    public function setMax(float $max): void
    {
        $this->max = $max;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = strtoupper($currency);
    }

    /**
     * @return string
     */
    public function getRate(): string
    {
        return $this->rate;
    }

    /**
     * @param string $rate
     */
    public function setRate(string $rate): void
    {
        $rate = strtolower($rate);
        if($this->isRateAllowed($rate)) {
            $this->rate = $rate;
        }
    }

    public function setSalaryWithNewRate(string $rate)
    {
        if($this->isRateAllowed($rate) && $this->getRate() !== $rate) {
            switch ($rate) {
                case "hour":
                    $this->calculateHourRates($this->getRate());
                    break;
                case "day":
                    $this->calculateDayRates($this->getRate());
                    break;
                case "month":
                    $this->calculateMonthRates($this->getRate());
                    break;
                case "year":
                    $this->calculateYearRates($this->getRate());
                    break;
            }
        }
    }

    public function exchangeCurrency(string $newCurrency, array $exchangeRatesForPln)
    {
        $newCurrency = strtoupper($newCurrency);
        if($newCurrency !== $this->getCurrency()) {
            $oldCurrencyRate = ($this->getCurrency() !== "PLN") ? $exchangeRatesForPln[$this->getCurrency()] : 1;
            $newCurrencyRate = ($newCurrency !== "PLN") ? $exchangeRatesForPln[$newCurrency] : 1;
            $exchangeRate = round($oldCurrencyRate / $newCurrencyRate, 3);
            $this->setMin($this->getMin() * $exchangeRate);
            $this->setMax($this->getMax() * $exchangeRate);
            $this->setCurrency($newCurrency);
        }
    }

    private function getAllowedRates() : array
    {
        return $this->allowedRates;
    }

    private function isRateAllowed(string $rate) : bool
    {
        $allowed = $this->getAllowedRates();

        if(in_array($rate, $allowed)) {
            return true;
        }  else {
            throw new \InvalidArgumentException("Allowed rates are: ".implode(", ", $allowed));
        }
    }

    protected function calculateHourRates(string $calcFrom)
    {
        if($this->isRateAllowed($calcFrom))
        {
            switch ($calcFrom) {
                case "day":
                    $this->setMin(round($this->getMin() / 8, 2));
                    $this->setMax(round($this->getMax() / 8, 2));
                    break;
                case "month":
                    $this->setMin(round($this->getMin() / 168, 2));
                    $this->setMax(round($this->getMax() / 168, 2));
                    break;
                case "year":
                    $this->setMin(round($this->getMin() / (160 * 12), 2));
                    $this->setMax(round($this->getMax() / (160 * 12), 2));
                    break;
            }
            $this->setRate("hour");
        }
    }

    protected function calculateDayRates(string $calcFrom)
    {
        if($this->isRateAllowed($calcFrom))
        {
            switch ($calcFrom) {
                case "hour":
                    $this->setMin(round($this->getMin() * 8, 2));
                    $this->setMax(round($this->getMax() * 8, 2));
                    break;
                case "month":
                    $this->setMin(round($this->getMin() / 22, 2));
                    $this->setMax(round($this->getMax() / 22, 2));
                    break;
                case "year":
                    $this->setMin(round($this->getMin() / 252, 2));
                    $this->setMax(round($this->getMax() / 252, 2));
                    break;
            }
            $this->setRate("day");
        }
    }

    protected function calculateMonthRates(string $calcFrom)
    {
        if($this->isRateAllowed($calcFrom))
        {
            switch ($calcFrom) {
                case "hour":
                    $this->setMin(round($this->getMin() * 168, 2));
                    $this->setMax(round($this->getMax() * 168, 2));
                    break;
                case "day":
                    $this->setMin(round($this->getMin() * 22, 2));
                    $this->setMax(round($this->getMax() * 22, 2));
                    break;
                case "year":
                    $this->setMin(round($this->getMin() / 12, 2));
                    $this->setMax(round($this->getMax() / 12, 2));
                    break;
            }
            $this->setRate("month");
        }
    }

    protected function calculateYearRates(string $calcFrom)
    {
        if($this->isRateAllowed($calcFrom))
        {
            switch ($calcFrom) {
                case "hour":
                    $this->setMin(round($this->getMin() * (168 * 12), 2));
                    $this->setMax(round($this->getMax() * (168 * 12), 2));
                    break;
                case "day":
                    $this->setMin(round($this->getMin() * 250, 2));
                    $this->setMax(round($this->getMax() * 250, 2));
                    break;
                case "month":
                    $this->setMin(round($this->getMin() * 12, 2));
                    $this->setMax(round($this->getMax() * 12, 2));
                    break;
            }
            $this->setRate("year");
        }
    }
}