<?php
namespace JobBoardCrawler\DataProvider\Website;

abstract class WebsiteDecorator implements WebsiteInterface
{
    protected $website;

    public function __construct(WebsiteInterface $website) {
        $this->website = $website;
    }
}
