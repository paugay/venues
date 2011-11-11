<?php

require_once "lib/domain/Venue.php";
require_once "lib/domain/Location.php";

$pausFlatLocation = new Venues\Domain\Location(
    30.30,
    40.4,
    "1 Mountview",
    "SW16 2RN",
    "London",
    "GB"
);

$pausFlat = new Venues\Domain\Venue(
    "Pau's flat",
    $pausFlatLocation
);

echo "this is a simple test case ... all good :) \n";

?>
