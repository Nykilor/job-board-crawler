<?php
namespace JobBoardCrawler\Model;

/**
 * Containes websites job offer basic data.
*/
class CooperationType
{
    const B2B = "b2b";
    const MANDATE_CONTRACT = "mandate contract";
    const EMPLOYMENT_CONTRACT = "employment contract";
    const CONTRACT_WORK = "task contract";

    const MONTHLY_RATE = "month";
    const DAILY_RATE = "day";
    const HOURLY_RATE = "hour";

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $salaryFrom;

    /**
     * @var int
     */
    private $salaryTo;

    /**
     * @var string
     */
    private $rate;

    /**
     * Get the value of Type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of Type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of Salary From
     *
     * @return int
     */
    public function getSalaryFrom()
    {
        return $this->salaryFrom;
    }

    /**
     * Set the value of Salary From
     *
     * @param int $salaryFrom
     *
     * @return self
     */
    public function setSalaryFrom($salaryFrom)
    {
        $this->salaryFrom = $salaryFrom;

        return $this;
    }

    /**
     * Get the value of Salary To
     *
     * @return int
     */
    public function getSalaryTo()
    {
        return $this->salaryTo;
    }

    /**
     * Set the value of Salary To
     *
     * @param int $salaryTo
     *
     * @return self
     */
    public function setSalaryTo($salaryTo)
    {
        $this->salaryTo = $salaryTo;

        return $this;
    }

    /**
     * Get the value of Rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of Rate
     *
     * @param string $rate
     *
     * @return self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    private

}
