<?php
namespace JobBoardCrawler\Factory;

interface WebsiteOfferDataNormalizerInterface
{
    /**
     * Normalizes the single offer data from a website for the factory to handle
     * @param  mixed $entryData The single offer data
     * @return array              Array for the JobOfferFactory to use
     */
    public function normalize($entryData) : array;
}
