<?php
namespace JobBoardCrawler\Model;

use JobBoardCrawler\Model\Collection\LocationCollection;

/**
 * Containes websites job offer basic data.
*/
class Url
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $title;

    /**
     * @var LocationCollection
     */
    private $location;

    /**
     * Get the value of Url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

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
     * Get the value of Location
     *
     * @return LocationCollection
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of Location
     *
     * @param LocationCollection $location
     *
     * @return self
     */
    public function setLocation(LocationCollection $location)
    {
        $this->location = $location;

        return $this;
    }
}
