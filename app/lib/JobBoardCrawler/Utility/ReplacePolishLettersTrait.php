<?php
namespace JobBoardCrawler\Utility;

/**
 * Replaces polish letters
 */
trait ReplacePolishLettersTrait
{
    public function replacePolishLetters(string $string) : string
    {
        $string = iconv('utf-8', 'ascii//TRANSLIT', $string);

        return $string;
    }
}
