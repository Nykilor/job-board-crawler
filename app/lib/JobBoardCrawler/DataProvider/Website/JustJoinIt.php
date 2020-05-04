<?php


namespace JobBoardCrawler\DataProvider\Website;

use Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use JobBoardCrawler\DataProvider\WebsiteInterface;
use JobBoardCrawler\Factory\WebsiteOfferDataNormalizerInterface;

class JustJoinIt implements WebsiteInterface
{

    private $baseUrl = "https://justjoin.it";

    /**
     * Creates a request to get given url.
     * @param  Client      $client           GuzzleHttp Client.
     * @param  array       $query            The query to fetch data by.
     */
    public function fetchOffers(Client $client, array $query) : Response {
        $response = $client->request("GET", $this->createUrl($query));

        return $response;
    }

    /**
     * Creates url based on given query parameters.
     * @param  array  $query Query parameters to fetch by.
     * @return string        Url containing given query parameters.
     */
    public function createUrl(array $query) : string {
        return $this->getBaseUrl()."/api/offers";
    }

    /**
     * Filters out the job offers from the html/json depending on the website.
     * @param  Response  $response Return data from fetchOffers method.
     * @param  array     $query    The base query for filtering if websites fetches all data in one go.
     */
    public function filterOffersFromResponse(Response $response, array $query) : Generator {
        $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        foreach ($body as $key => $item) {
            var_dump($key, $item);
            exit();
        }
    }

    /**
     * The normalizer to create an array for JobOffer creation.
     * @return WebsiteOfferDataNormalizerInterface
     */
    public function getNormalizer() : WebsiteOfferDataNormalizerInterface {

    }

    public function getBaseUrl() : string {
        return $this->baseUrl;
    }
}