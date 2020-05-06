<?php
namespace JobBoardCrawler\DataProvider;

use Generator;

use GuzzleHttp\Client;

use GuzzleHttp\Psr7\Response;

use JobBoardCrawler\Factory\WebsiteOfferDataNormalizerInterface;
use JobBoardCrawler\Model\Query;

/**
 * Interface for Website classes
 */
interface WebsiteInterface
{
    /**
     * Creates a request to get given url.
     * @param Client $client GuzzleHttp Client.
     * @param Query $query The query to fetch data by.
     * @return Response
     */
    public function fetchOffers(Client $client, Query $query) : Response;

    /**
     * Creates url based on given query parameters.
     * @param Query $query Query parameters to fetch by.
     * @return string        Url containing given query parameters.
     */
    public function createUrl(Query $query) : string;

    /**
     * Filters out the job offers from the html/json depending on the website.
     * @param Response $response Return data from fetchOffers method.
     * @param Query $query The base query for filtering if websites fetches all data in one go.
     * @return Generator
     */
    public function filterOffersFromResponse(Response $response, Query $query) : Generator;

    /**
     * The normalizer to create an array for JobOffer creation.
     * @return WebsiteOfferDataNormalizerInterface
     */
    public function getNormalizer() : WebsiteOfferDataNormalizerInterface;
}
