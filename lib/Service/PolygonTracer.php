<?php

namespace Venues\Service;

/**
 * Polygon tracer
 *
 * This service calculates all the points that we need to parse all 
 * venues within a polygon. Basically it will be usefull to search which 
 * locations (lat-lon coordinates) do we have to request into a Venues 
 * API in order to optimize the searching.
 *
 * @version     $Id$
 * @package     Venues
 * @subpackage  Service
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class PolygonTracer
{
    /**
     * Polygon
     *
     * The polygon that we want to trace.
     *
     * @var Polygon
     */
    protected $polygon;

    /**
     * Threshold
     *
     * We are going to divide the polygon in smaller polygons until the 
     * distance between minLat and maxLat OR minLon and maxLon is 
     * smaller than the threshold.
     *
     * Unit measure is km.
     *
     * @var Float
     */
    private static $threshold = 5;

    /**
     * Constructor
     *
     * @param Polygon $polygon
     */
    public function __construct(
        \Venues\Domain\Location\Polygon $polygon
    )
    {
        $this->polygon = $polygon;
    }

    /**
     * Get traces
     *
     * Method that will return the traces of the polygon. It is 
     * basically a set (list) of locations in the concrete order that we 
     * should parse.
     *
     * @return LocationList
     */
    public function getTraces()
    {
        $this->getTracesRecursive($this->polygon);
    }

    public function getTracesRecursive(\Venues\Domain\Location\Polygon $polygon)
    {
        $center = $polygon->getCenter();


        $polygonList = $polygon->divideInFour($center, self::$threshold);
        die;

        foreach ($polygonList as $p)
        {
            $this->getTracesRecursive($p);
        }
    }
}
