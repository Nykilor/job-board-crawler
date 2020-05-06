<?php


namespace JobBoardCrawler\Normalizer;


use JobBoardCrawler\DataProvider\Website\JustJoinIt;
use JobBoardCrawler\Factory\WebsiteOfferDataNormalizerInterface;
use JobBoardCrawler\Model\Collection\LocationCollection;
use JobBoardCrawler\Model\Collection\UrlCollection;
use JobBoardCrawler\Model\Location;
use JobBoardCrawler\Model\Salary;
use JobBoardCrawler\Model\Url;

class JustJoinItNormalizer implements WebsiteOfferDataNormalizerInterface
{
    public function normalize($entryData) : array
    {
        $array = [];
        $array["title"] = $entryData["title"];

        $array["technology"] = array_map(function ($entry) {
            return $entry["name"];
        }, $entryData["skills"]);

        $locationCollection = new LocationCollection();

        if ($entryData["remote"]) {
            $locationRemote = new Location();
            $locationRemote->setAdress("Remote");
            $locationCollection[] = $locationRemote;
        }

        $locationCity = new Location();
        $locationCity->setLatitude($entryData["latitude"]);
        $locationCity->setLongitude($entryData["longitude"]);
        $locationCity->setAdress($entryData["city"]);

        $locationCollection[] = $locationCity;

        $urlJob = new Url();
        $urlJob->setUrl(JustJoinIt::BASE_URL."offers/".$entryData["id"]);
        $urlJob->setTitle("offer");
        $urlJob->setLocation($locationCollection);

        $urlCompany = new Url();
        $urlCompany->setUrl($entryData["company_url"]);
        $urlCompany->setTitle("company_homepage");

        $urlCollection = new UrlCollection();
        $urlCollection->addItem($urlJob);
        $urlCollection->addItem($urlCompany);

        $array["exp"] = $entryData["experience_level"];
        $array["url"] = $urlCollection;
        $array["post_time"] = new \DateTime($entryData["published_at"]);
        $array["company"] = $entryData["company_name"];

        if (!is_null($entryData["salary_from"])) {
            $salary = new Salary();
            $salary->setMin($entryData["salary_from"]);
            $salary->setMax($entryData["salary_to"]);
            $salary->setCurrency($entryData["salary_currency"]);
            $salary->setRate("month");
        } else {
            $salary = null;
        }

        $array["salary"] = $salary;
        $array["contract_type"] = $entryData["employment_type"];

        return $array;
    }
}