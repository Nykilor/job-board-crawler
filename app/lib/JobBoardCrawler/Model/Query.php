<?php


namespace JobBoardCrawler\Model;


use JobBoardCrawler\Utility\StandardizeStringTrait;

class Query
{
    use StandardizeStringTrait;
    /**
     * @var array
     */
    private $skill;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $seniority;

    /**
     * @var Salary
     */
    private $salary;

    /**
     * @var string
     */
    private $contractType;

    /**
     * @var bool
     */
    private $requiredSalary = false;

    /**
     * @var bool
     */
    private $onlyRemote = false;

    /**
     * @var array|null
     */
    private $currencyExchangeRates = null;

    /**
     * @return array
     */
    public function getSkill(): array
    {
        return $this->skill;
    }

    /**
     * @param array $skill
     */
    public function setSkill(array $skill): void
    {
        $fixSkillArray = [];
        foreach ($skill as $fixSkill) {
            $fixSkillArray[] = $this->standardizeString($fixSkill);
        }
        $this->skill = $fixSkillArray;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $this->standardizeString($city);
    }

    /**
     * @return string
     */
    public function getSeniority(): string
    {
        return $this->seniority;
    }

    /**
     * @param string $seniority
     * @throws \Exception
     */
    public function setSeniority(string $seniority): void
    {
        $seniority = strtolower($seniority);
        $allowedSeniority = ["intern", "junior", "regular", "senior"];
        if(in_array($seniority, $allowedSeniority)) {
            $this->seniority = $seniority;
        } else {
            throw new \Exception("Allowed seniorities are: ".implode(",", $allowedSeniority));
        }

    }

    /**
     * @return Salary
     */
    public function getSalary(): Salary
    {
        return $this->salary;
    }

    /**
     * @param Salary $salary
     */
    public function setSalary(Salary $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getContractType(): string
    {
        return $this->contractType;
    }

    /**
     * @param string $contractType
     */
    public function setContractType(string $contractType): void
    {
        //Contract = umowa o dzieło, mandate = umowa zlecenie, permanent = umowa o prace, b2b = firma - firma
        $allowedContractTypes = ["b2b", "permanent", "mandate", "contract"];
        if(in_array($contractType, $allowedContractTypes)) {
            $this->contractType = $contractType;
        } else {
            throw new \Exception("Allowed contract types are: ".implode(",", $allowedContractTypes));
        }
    }

    /**
     * @return bool
     */
    public function isRequiredSalary(): bool
    {
        return $this->requiredSalary;
    }

    /**
     * @param bool $requiredSalary
     */
    public function setRequiredSalary(bool $requiredSalary): void
    {
        $this->requiredSalary = $requiredSalary;
    }

    /**
     * @return bool
     */
    public function isOnlyRemote(): bool
    {
        return $this->onlyRemote;
    }

    /**
     * @param bool $onlyRemote
     */
    public function setOnlyRemote(bool $onlyRemote): void
    {
        $this->onlyRemote = $onlyRemote;
    }

    /**
     * @return array|null
     */
    public function getCurrencyExchangeRates(): ?array
    {
        return $this->currencyExchangeRates;
    }

    /**
     * @param array|null $currencyExchangeRates
     */
    public function setCurrencyExchangeRates(?array $currencyExchangeRates): void
    {
        $this->currencyExchangeRates = $currencyExchangeRates;
    }


}