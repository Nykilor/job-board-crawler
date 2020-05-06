<?php


namespace JobBoardCrawler\DataProvider;


use JobBoardCrawler\Translator\AbstractTranslator;

interface HasTranslatorClassInterface
{
    /**
     * Returns class for translating given Query parameters for the website to understand.
     * @return AbstractTranslator
     */
    public function getTranslator() : AbstractTranslator;
}