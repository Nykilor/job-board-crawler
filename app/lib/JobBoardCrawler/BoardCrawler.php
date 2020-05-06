<?php
namespace JobBoardCrawler;

use GuzzleHttp\Client;

use GuzzleHttp\Psr7\Response;
use JobBoardCrawler\DataProvider\WebsiteInterface;
use JobBoardCrawler\Exception\InvalidQueryException;
use JobBoardCrawler\Exception\MissingClassPropertyException;
use JobBoardCrawler\Model\Collection\JobOfferCollection;
use JobBoardCrawler\Model\Query;

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
     * @var Query
     */
    private $query;

    /**
     * @var array
     */
    private $currencyExchangeRates;

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
            if ($website instanceof WebsiteInterface) {
                $this->websites[] = $website;
            } else {
                throw new \Exception("Invalid class: ".get_class($website));
            }
        }
    }

    public function setQuery(Query $query)
    {
        $this->query = ($this->validateQuery($query)) ? $query : null;
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
            $response = $website_class_instance->fetchOffers($this->client, $this->query);

            foreach ($website_class_instance->filterOffersFromResponse($response, $this->query) as $item) {
                
            }
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
            $msg .= ($is_query_empty) ? " setQuery()" : "";
            throw new MissingClassPropertyException($msg);
        }
    }

    protected function validateQuery(Query $query){
        //TODO add the contract types validation if exists,
        //TODO Add the contract types check in justJoinIt
        //TODO add the  translator use and the normalizer use for the fetch
        $city = $query->getCity();
        $skill = $query->getSkill();
        $salary = $query->getSalary();
        $seniority = $query->getSeniority();

        $quickCheckArray = [$city,$skill,$salary,$seniority];

        if(empty(array_filter($quickCheckArray))) {
            throw new InvalidQueryException("Query has to have at least one parameter set.");
        }

        if(!is_null($salary)) {
            $min = $salary->getMin();
            $currency = $salary->getCurrency();
            $rate = $salary->getRate();
            $quickCheckArray = [$min, $currency, $rate];

            if(is_null($query->getCurrencyExchangeRates())) {
                $exchangeApi = new \BenMajor\ExchangeRatesAPI\ExchangeRatesAPI();
                $currencyExchangeRates = $exchangeApi->setBaseCurrency("PLN")->fetch();
                $query->setCurrencyExchangeRates($currencyExchangeRates->getRates());
            }

            if(count(array_filter($quickCheckArray)) !== 3) {
                throw new InvalidQueryException("Query->getSalary() has to have the min, currency and rate set");
            }
        }

        return true;
    }
}
