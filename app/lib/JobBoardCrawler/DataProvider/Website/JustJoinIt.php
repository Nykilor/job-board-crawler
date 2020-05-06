<?php


namespace JobBoardCrawler\DataProvider\Website;

use Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use JobBoardCrawler\DataProvider\HasTranslatorClassInterface;
use JobBoardCrawler\DataProvider\WebsiteInterface;
use JobBoardCrawler\Factory\WebsiteOfferDataNormalizerInterface;
use JobBoardCrawler\Model\Query;
use JobBoardCrawler\Normalizer\JustJoinItNormalizer;
use JobBoardCrawler\Translator\AbstractTranslator;
use JobBoardCrawler\Translator\JustJoinItTranslator;
use JobBoardCrawler\Utility\StandardizeStringTrait;

class JustJoinIt implements WebsiteInterface, HasTranslatorClassInterface
{
    use StandardizeStringTrait;
    const BASE_URL = "https://justjoin.it";
    private $seniorityTranslator = [
        "intern" => null,
        "junior" => "junior",
        "regular" => "mid",
        "senior" => "senior"
    ];

    /**
     * Creates a request to get given url.
     * @param Client $client GuzzleHttp Client.
     * @param Query $query The query to fetch data by.
     * @return Response
     */
    public function fetchOffers(Client $client, Query $query) : Response {
        return $client->request("GET", $this->createUrl($query));
    }

    /**
     * Creates url based on given query parameters.
     * @param Query $query Query parameters to fetch by.
     * @return string        Url containing given query parameters.
     */
    public function createUrl(Query $query) : string {
        return self::BASE_URL."/api/offers";
    }

    /**
     * Filters out the job offers from the html/json depending on the website.
     * @param Response $response Return data from fetchOffers method.
     * @param Query $query The base query for filtering if websites fetches all data in one go.
     * @return Generator
     * @throws \JsonException
     */
    public function filterOffersFromResponse(Response $response, Query $query) : Generator {
        $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        //skills in 'marker_icon' and array 'skills' x
        //city in 'city' x
        //salary in 'salary_from', 'salary_to', 'salary_currency'
        //remote in 'remote' x
        //seniority in 'experience_level' x
        $remoteOnly = $query->isOnlyRemote();
        $skills = $query->getSkill();
        $seniority = ($query->getSeniority())? $this->seniorityTranslator[$query->getSeniority()] : null;
        foreach ($body as $jobOffer) {
            //remote work
            if($remoteOnly && $jobOffer["remote"] === false) {
                continue;
            }
            //seniority
            if(is_null($seniority) || $seniority !== $jobOffer["experience_level"]) {
                continue;
            }
            //skill
            if(!is_null($skills)) {
                $itemSkills = [];
                foreach ($jobOffer["skills"] as $itemSkillSingle) {
                    $itemSkills[] = $this->standardizeString($itemSkillSingle["name"]);
                }
                if(!in_array($jobOffer["marker_icon"], $skills) || empty(array_intersect($skills, $itemSkills))) {
                    continue;
                }
            }
            //city
            $city = $query->getCity();
            if(!is_null($city) && $this->standardizeString($jobOffer["city"]) !== $city) {
                continue;
            }
            if(!is_null($query->isRequiredSalary()) && is_null($jobOffer["salary_currency"])) {
                continue;
            }
            //salary
            $isNotNullQuerySalary = !is_null($query->getSalary());
            if($isNotNullQuerySalary && is_null($jobOffer["salary_currency"])) {
                continue;
            } else if($isNotNullQuerySalary) {
                $querySalaryModel = $query->getSalary();
                $itemMinSalary = $jobOffer["salary_from"];
                $itemMaxSalary = $jobOffer["salary_to"];
                $itemSalaryCurrency = strtolower($jobOffer["salary_currency"]);

                if($itemSalaryCurrency !== $querySalaryModel->getCurrency()) {
                    $querySalaryModel->exchangeCurrency($itemSalaryCurrency, $query->getCurrencyExchangeRates());
                }

                if($querySalaryModel->getRate() !== "month") {
                    $querySalaryModel->setSalaryWithNewRate("month");
                }

                $queryMinSalary = $querySalaryModel->getMin();
                if($itemMinSalary < $queryMinSalary || $itemMaxSalary < $queryMinSalary) {
                    continue;
                }
            }
            yield $jobOffer;
        }
    }

    /**
     * The normalizer to create an array for JobOffer creation.
     * @return WebsiteOfferDataNormalizerInterface
     */
    public function getNormalizer() : WebsiteOfferDataNormalizerInterface {
        return new JustJoinItNormalizer();
    }

    /**
     * Returns class for translating given Query parameters for the website to understand.
     * @return AbstractTranslator
     */
    public function getTranslator() : AbstractTranslator {
        return new JustJoinItTranslator();
    }
}