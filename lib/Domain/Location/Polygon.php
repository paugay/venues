<?php

namespace Venues\Domain\Location;

/**
 * Polygon
 *
 * Represents a set of locations that form a polygon. Each polygon is 
 * asociated with a certain City and Country.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class Polygon
    implements Polygon\PolygonInterface
{
    /**
     * Location list
     *
     * The list of locations that represents the point of the polygon.
     *
     * @var LocationList
     */
    protected $locationList;

    /**
     * City
     *
     * The city that is mapped within the polygon.
     *
     * @var String
     */
    protected $city;

    /**
     * Country code
     *
     * The ISO 3166 code that represents the country.
     *
     * @var String
     */
    protected $countryCode;

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
        LocationList $locationList,
        $city,
        $countryCode
    )
    {
        if ($locationList->count() <= 2)
        {
            throw new \Venues\Error\BadParameter(
                'Error: You can\'t construct a polygon with 2 points.'
            );
        }

        if (!\Venues\Domain\Location::isValidCountryCode($countryCode))
        {
            throw new \Venues\Error\BadParameter(
                'Error: Country code \'' . $countryCode . '\' is not a '
                . 'valid code according to ISO 3166 aplha 2.'
            );
        }

        $this->locationList = $locationList;
        $this->city = $city;
        $this->countryCode = $countryCode;
    }

    /**
     * Get location list
     *
     * @return LocationList
     */
    public function getLocationList()
    {
        return $this->locationList;
    }

    /**
     * Get city
     *
     * @return String
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get country code
     *
     * @return String
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    // --- public methods
    
    /**
     * Get center
     *
     * Method that returns the center of a polygon.
     *
     * @return Location
     */
    public function getCenter()
    {
        // east = min lat
        $minLat = NULL;

        // west = max lat
        $maxLat = NULL;

        // north = max lon
        $maxLon = NULL;

        // south = min lon
        $minLon = NULL;

        foreach ($this->locationList as $location)
        {
            if (
                $minLat === NULL
                ||
                $location->getLat() < $minLat
            )
            {
                $minLat = $location->getLat();
            }

            if (
                $maxLat === NULL
                ||
                $location->getLat() > $maxLat 
            )
            {
                $maxLat = $location->getLat();
            }

            if (
                $maxLon === NULL
                ||
                $location->getLon() > $maxLon 
            )
            {
                $maxLon = $location->getLon();
            }

            if (
                $minLon === NULL
                ||
                $location->getLon() < $minLon
            )
            {
                $minLon = $location->getLon();
            }
        }

        $centerLat = $minLat + (($maxLat - $minLat) / 2);
        $centerLon = $minLon + (($maxLon - $minLon) / 2);

        return new \Venues\Domain\Location(
            $centerLat,
            $centerLon,
            NULL,
            NULL,
            $this->getCity(),
            $this->getCountryCode()
        );
    }

    /**
     * Divide in four
     *
     * TO_DO
     *
     * @param Polygon $polygon
     *
     * @return PolygonList
     */
    public function divideInFour(
        \Venues\Domain\Location $center,
        $threshold
    )
    {
        echo "Center:\n";
        echo $center->getLat();
        echo ",";
        echo $center->getLon();
        echo "\n\n";

        $perimeter = new \Venues\Domain\Location\LocationList();
        $previous = $this->locationList->end();
        $perimeter->add($previous);

        foreach ($this->locationList as $next)
        {
            echo "--------------------------\n";
            echo "Iteration ... \n";
            echo "--------------------------\n\n";

            echo "Previous / Next:\n";
            echo $previous->getLat();
            echo ",";
            echo $previous->getLon();
            echo " / ";
            echo $next->getLat();
            echo ",";
            echo $next->getLon();
            echo "\n\n";

            echo "Lat (previous,center,next):\n";
            echo $previous->getLat() . ",";
            echo $center->getLat() . ",";
            echo $next->getLat() . "\n\n";
            echo "Lon (previous,center,next):\n";
            echo $previous->getLon() . ",";
            echo $center->getLon() . ",";
            echo $next->getLon() . "\n\n";

            $perimeter->add($next);

            if (
                (
                    $previous->getLat() > $center->getLat()
                    &&
                    $center->getLat() > $next->getLat()
                )
                ||
                (
                    $next->getLat() > $center->getLat()
                    &&
                    $center->getLat() > $previous->getLat()
                )
            )
            {
                /*
                 * Create a new point where lat = $center->getLat().
                 *
                 * In order to calculate lon we need to figure out the 
                 * equation that represents the line (calculating first 
                 * m and then b) and for the concrete lat figure out the 
                 * lon.
                 */

                // caluclate m
                $m = ($next->getLat() - $previous->getLat()) / 
                    ($next->getLon() - $previous->getLon());

                // calculate b
                $b = (
                        ($previous->getLat() * $next->getLon()) - 
                        ($next->getLat() * $previous->getLon())
                    ) /
                    ($next->getLon() - $previous->getLon());


                $lat = $center->getLat();
                // x = (y - b) / m
                $lon = ($lat - $b) / $m;

                echo "New point created: $lat,$lon\n\n";
                $newLocation = new \Venues\Domain\Location(
                    $lat,
                    $lon,
                    NULL,
                    NULL,
                    $this->getCity(),
                    $this->getCountryCode()
                );

                $perimeter->add($newLocation);
            }

            if (
                (
                    $previous->getLon() > $center->getLon()
                    &&
                    $center->getLon() > $next->getLon()
                )
                ||
                (
                    $next->getLon() > $center->getLon()
                    &&
                    $center->getLon() > $previous->getLon()
                )
            )
            {
                /*
                 * Create a new point where lon = $center->getLon().
                 *
                 * In order to calculate lat we need to figure out the 
                 * equation that represents the line (calculating first 
                 * m and then b) and for the concrete lat figure out the 
                 * lon.
                 */

                // caluclate m
                $m = ($next->getLat() - $previous->getLat()) / 
                    ($next->getLon() - $previous->getLon());

                // calculate b
                $b = (
                        ($previous->getLat() * $next->getLon()) - 
                        ($next->getLat() * $previous->getLon())
                    ) /
                    ($next->getLon() - $previous->getLon());


                $lon = $center->getLon();
                // y = m * x + b
                $lat = $m * $lon + $b;

                echo "New point created: $lat,$lon\n\n";
                $newLocation = new \Venues\Domain\Location(
                    $lat,
                    $lon,
                    NULL,
                    NULL,
                    $this->getCity(),
                    $this->getCountryCode()
                );

                $perimeter->add($newLocation);
            }


            $previous = $next;
        }

        // var_dump($perimeter);
    }
}
