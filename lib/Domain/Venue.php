<?php

namespace Venues\Domain;

/**
 * Venue
 *
 * Represents any kind of venue or place in the world. It has his own 
 * location and other parametres that define the properties of the 
 * venue.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class Venue
    extends KeyedObject
    implements Venue\IVenue
{
    /**
     * Key
     *
     * @var Integer;
     */
    protected $key;

    /**
     * Title
     *
     * @var String
     */
    protected $title;

    /**
     * Location
     *
     * @var Location
     */
    protected $location;

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
        Location $location
    )
    {
        if (!is_int($key))
        {
            throw new \Venues\Error\BadParameter(
                'Error: Key needs a numeric value.'
            );
        }

        if (empty($title))
        {
            throw new \Venues\Error\BadParameter(
                'Error: Title has a empty value.'
            );
        }

        $this->key = $key;
        $this->title = $title;
        $this->location = $location;
    }

    /**
     * Get title
     *
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get location
     *
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

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
        Location $location
    )
    {
        return $this->getLocation()->getDistanceTo($location);
    }
}
