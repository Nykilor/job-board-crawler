<?php


namespace JobBoardCrawler\Translator;


interface QueryContractTypeTranslatorInterface
{
    /**
     * Converts standard Query contract type string to one understandable by given website.
     * @param string $contractType
     * @return string|null
     */
    public function translateContractType(string $contractType) : ?string;

    /**
     * Returns the array with currently used translation
     * @return array
     */
    public function getContractTypeTranslations() : array;
}