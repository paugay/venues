<?php

require_once dirname(__DIR__) . "/venues.php";

$list = new Venues\Domain\Location\LocationList();

$home = new Venues\Domain\Location(
    31.30,
    41.4
);

$pausFlatLocation = new Venues\Domain\Location(
    30.30,
    40.4,
    "1 Mountview",
    "SW16 2RN",
    "London",
    "GB"
);

$list->add($home);
var_dump($list->count());

$list->add($pausFlatLocation);
var_dump($list->count());

$list->add($pausFlatLocation);
var_dump($list->count());

echo "\nall good :) \n\n";

?>
