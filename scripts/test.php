<?php

namespace Venues;

require_once "lib/domain/Venue.php";
require_once "lib/domain/Location.php";

$pausFlatLocation = new Location(
    30.30,
    40.4,
    "Flat 1 Mountview",
    "SW16 2RN",
    "London",
    "UK"
);

$pausFlat = new Venue(
    "Pau's flat",
    $pausFlatLocation
);

echo "all good\n";

?>
