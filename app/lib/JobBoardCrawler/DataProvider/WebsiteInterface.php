<?php
namespace JobBoardCrawler\DataProvider;

use Generator;

use GuzzleHttp\Client;

use GuzzleHttp\Psr7\Response;

use JobBoardCrawler\Factory\WebsiteOfferDataNormalizerInterface;

/**
 * Interface for Website classes
 */
interface WebsiteInterface
{
    /**
     * Creates a request to get given url.
     * @param  Client      $client           GuzzleHttp Client.
     * @param  array       $query            The query to fetch data by.
     */
    public function fetchOffers(Client $client, array $query) : Response;

    /**
     * Creates url based on given query parameters.
     * @param  array  $query Query parameters to fetch by.
     * @return string        Url containing given query parameters.
     */
    public function createUrl(array $query) : string;

    /**
     * Filters out the job offers from the html/json depending on the website.
     * @param  Response  $response Return data from fetchOffers method.
     */
    public function filterOffersFromResponse(Response $response) : Generator;

    /**
     * The normalizer to create an array for JobOffer creation.
     * @return WebsiteOfferDataNormalizerInterface
     */
    public function getNormalizer() : WebsiteOfferDataNormalizerInterface;
}
