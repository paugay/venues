<?php

require_once dirname(__DIR__) . "/venues.php";

$pausFlatLocation = new Venues\Domain\Location(
    30.30,
    40.4,
    "1 Mountview",
    "SW16 2RN",
    "London",
    "GB"
);

$pausFlat = new Venues\Domain\Venue(
    123,
    "Pau's flat",
    $pausFlatLocation
);

echo "this is a simple test case ... all good :) \n\n";

var_dump($pausFlat);

?>
