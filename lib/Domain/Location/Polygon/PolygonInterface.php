<?php

namespace Venues\Domain\Location\Polygon;

/**
 * Polygon interface
 *
 * Represents a set of locations that form a polygon. Each polygon is 
 * asociated with a certain City and Country.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

interface PolygonInterface
{
    /**
     * Constructor
     *
     * Method that maps the polygon. The order of the elements on the 
     * list is relevant. Pe. Having 4 points (A, B, C, D) the polygon is 
     * formed by the lines that draw A-B, B-C, C-D and D-A.
     *
     * @param LocationList $list
     */
    public function __construct(
        \Venues\Domain\Location\LocationList $locationList,
        $city,
        $countryCode
    );

    /**
     * Get location list
     *
     * @return LocationList
     */
    public function getLocationList();

    /**
     * Get city
     *
     * @return String
     */
    public function getCity();

    /**
     * Get country code
     *
     * @return String
     */
    public function getCountryCode();
}
