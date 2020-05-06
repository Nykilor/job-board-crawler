<pre>
<?php
require __DIR__ . '/vendor/autoload.php';

$websites = [
    new \JobBoardCrawler\DataProvider\Website\JustJoinIt()
];
$query = new \JobBoardCrawler\Model\Query();
$query->setSeniority("junior");
$query->setCity("Poznań");

$class = new \JobBoardCrawler\BoardCrawler();
$class->setWebsites($websites);
$class->setQuery($query);
$class->fetch(1,1);