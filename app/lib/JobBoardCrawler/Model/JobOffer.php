<?php
namespace JobBoardCrawler\Model;

use JobBoardCrawler\Model\Collection\UrlCollection;
use \DateTime;

/**
 * Containes websites job offer basic data.
 */
class JobOffer
{
    /**
    * @var string
    */
    private $title;

    /**
    * @var string
    */
    private $exp;

    /**
     * @var UrlCollection
     */
    private $url;

    /**
     * @var array
     */
    private $technology;

    /**
     * @var DateTime
     */
    private $postTime;

    /**
     * @var string
     */
    private $company;

    /**
     * @var CooperationTypeCollection
     */
    private $cooperationTypes;

    /**
     * Get the value of Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Exp
     *
     * @return string
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set the value of Exp
     *
     * @param string $exp
     *
     * @return self
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get the value of Url
     *
     * @return UrlCollection
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Url
     *
     * @param UrlCollection $url
     *
     * @return self
     */
    public function setUrl(UrlCollection $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of Technology
     *
     * @return array
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Set the value of Technology
     *
     * @param array $technology
     *
     * @return self
     */
    public function setTechnology(array $technology)
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * Get the value of Post Time
     *
     * @return DateTime
     */
    public function getPostTime()
    {
        return $this->postTime;
    }

    /**
     * Set the value of Post Time
     *
     * @param DateTime $postTime
     *
     * @return self
     */
    public function setPostTime(DateTime $postTime)
    {
        $this->postTime = $postTime;

        return $this;
    }

    /**
     * Get the value of Company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of Company
     *
     * @param string $company
     *
     * @return self
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get the value of Cooperation Types
     *
     * @return CooperationTypeCollection
     */
    public function getCooperationTypes()
    {
        return $this->cooperationTypes;
    }

    /**
     * Set the value of Cooperation Types
     *
     * @param CooperationTypeCollection $cooperationTypes
     *
     * @return self
     */
    public function setCooperationTypes(CooperationTypeCollection $cooperationTypes)
    {
        $this->cooperationTypes = $cooperationTypes;

        return $this;
    }
}
