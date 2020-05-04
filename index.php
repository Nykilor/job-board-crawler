<pre>
<?php
require __DIR__ . '/vendor/autoload.php';


$websites = [
    new \JobBoardCrawler\DataProvider\Website\JustJoinIt()
];
$class = new \JobBoardCrawler\BoardCrawler();
$class->setWebsites($websites);
$class->setQuery(["test" => "test"]);
$class->fetch(1,1);