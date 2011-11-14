<?php

namespace Venues\Domain\Venue;

/**
 * Venue interface
 *
 * Represents any kind of venue or place in the world. It has his own 
 * location and other parametres that define the properties of the 
 * venue.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

interface VenueInterface
    extends \Venues\Keyed\KeyedObjectInterface
{
    /**
     * Constructor
     *
     * @param Integer $key
     * @param String $title
     * @param Location $location
     */
    public function __construct(
        $key,
        $title,
        \Location $location
    );

    /**
     * Get title
     *
     * @return String
     */
    public function getTitle();

    /**
     * Get location
     *
     * @return Location
     */
    public function getLocation();

    // --- public methods

    /**
     * Get distance to
     *
     * Method that return the distance on km from the current venue 
     * location to the $location location.
     *
     * @param Location $location
     *
     * @return Float Distance from the current location to $to in km.
     */
    public function getDistanceTo(
        \Location $location
    );
}
