<?php
namespace JobBoardCrawler;

use GuzzleHttp\Client;

use GuzzleHttp\Psr7\Response;

/**
 * Base class to use the library with
 */
class BoardCrawler
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $websites;

    /**
     * @var JobOfferCollection
     */
    private $offers;

    /**
     * @var array
     */
    private $query;

    public function __construct(array $client_config = [])
    {
        $this->client = (!empty($client_config)) ? new Client($client_config) : new Client();
        $this->offers = new JobOfferCollection();
    }

    /**
     * Set the websites to get data from.
     * @param array $websites
     */
    public function setWebsites(array $websites)
    {
        foreach ($websites as $website) {
            if ($websites instanceof WebsiteInterface) {
                $this->websites[] = $website;
            } else {
                throw new \Exception("Invalid class: ".get_class($website));
            }
        }
    }

    public function setQuery(array $query)
    {
        $this->query = $query;
    }

    /**
     * Initate the fetching of the data for setted websites by setted query
     * @param  bool $strict         If true the websites that f.i. don't allow a technology "php" will be omited
     * @param  int $max_pages       If a websites chunks the results in pages we can set up the max amount of pages to fetch
     * @return Generator|void
     */
    public function fetch(bool $strict, int $max_pages)
    {
        $this->isQueryAndWebsiteSet();

        foreach ($this->websites as $website_class_instance) {
            // code...
        }
    }

    /**
     * Method that checks if the query and website property of this class is set.
     */
    protected function isQueryAndWebsiteSet() : void
    {
        $is_websites_empty = empty($this->websites);
        $is_query_empty = empty($this->query);

        if ($is_websites_empty or $is_query_empty) {
            $msg = "You need to call";
            $msg .= ($is_websites_empty) ? " setWebsites()" : "";
            $msg .= ($is_query_creator_empty) ? " setQuery()" : "";
            throw new MissingClassPropertyException($msg);
        }
    }
}
