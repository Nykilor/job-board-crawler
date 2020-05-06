<?php


namespace JobBoardCrawler\Translator;


class JustJoinItTranslator extends AbstractTranslator implements QueryContractTypeTranslatorInterface
{
    private $contractTypeTranslation = [
        "mandate" => "mandate_contract",
        "contract" => null
    ];

    /**
     * Converts standard Query contract type string to one understandable by given website.
     * @param string $contractType
     * @return string|null
     */
    public function translateContractType(string $contractType) : ?string
    {
        $returnString = $contractType;
        $translation = $this->getContractTypeTranslation();
        if(array_key_exists($contractType, $translation)) {
            $returnString = $translation[$contractType];
        }

        return $returnString;
    }

    /**
     * Returns the array with currently used translation
     * @return array
     */
    public function getContractTypeTranslations() : array
    {
        return $this->contractTypeTranslation;
    }
}