<?php

require_once dirname(__DIR__) . "/venues.php";

$points = array(
    array(41.33815377536821, 2.168426513671875),
    array(41.378869509663225, 2.098388671875),
    array(41.4504467428547, 2.1869659423828125),
    array(41.41029081288079, 2.2405242919921875),
);

$list = new Venues\Domain\Location\LocationList();

foreach ($points as $point)
{
    $list->add(
        new Venues\Domain\Location(
            $point[0],
            $point[1]
        )
    );
}

$barcelona = new Venues\Domain\Location\Polygon(
    $list,
    'Barcelona',
    'ES'
);

$polygonTracer = new Venues\Service\PolygonTracer($barcelona);

$polygonTracer->getTraces();

?>
