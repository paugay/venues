<?php

namespace Venues\Domain\Location;

/**
 * Location interface
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

interface LocationInterface
{
    /**
     * Constructor
     * 
     * @param Float $lat
     * @param Float $lon
     * @param String $address
     * @param String $postcode
     * @param String $city
     * @param String $countryCode
     *
     */
    public function __construct(
        $lat,
        $lon,
        $address = NULL,
        $postcode = NULL,
        $city = NULL,
        $countryCode = NULL
    );

    /**
     * Get lat
     *
     * @return Float
     */
    public function getLat();

    /**
     * Get lon
     *
     * @return Float
     */
    public function getLon();

    /**
     * Get address
     *
     * @return String
     */
    public function getAddress();

    /**
     * Get postcode
     *
     * @return String
     */
    public function getPostcode();

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

    // --- public methods
    
    /**
     * Get distance to
     *
     * Method that return the distance on km from the current location 
     * into the $to location.
     *
     * Using the Harvesine formula, extracted from:
     *     http://www.movable-type.co.uk/scripts/latlong.html
     *
     * @param Location $to
     *
     * @return Float Distance from the current location to $to in km.
     */
    public function getDistanceTo(\Location $to);
}
