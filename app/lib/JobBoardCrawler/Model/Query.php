<?php


namespace JobBoardCrawler\Model;


class Query
{
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

    private $salary;

    /**
     * @var bool
     */
    private $requiredSalary;

    /**
     * @var bool
     */
    private $remote;
}