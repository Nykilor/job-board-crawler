<?php
namespace JobBoardCrawler\Model;

/**
 * Containes websites job offer basic data.
*/
class Location
{
    /**
     * @var string
     */
    private $adress = null;

    /**
     * @var float
     */
    private $latitude = null;

    /**
     * @var float
     */
    private $longitude = null;

    /**
     * Get the value of Adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of Adress
     *
     * @param string $adress
     *
     * @return self
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of Latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of Latitude
     *
     * @param float $latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the value of Longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of Longitude
     *
     * @param float $longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }
}
