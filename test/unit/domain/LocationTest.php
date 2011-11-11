<?php

require_once 'lib/domain/Location.php';

/**
 * Location test
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class LocationTest 
    extends PHPUnit_Framework_TestCase
{
    private $lat;
    private $lon;
    private $address;
    private $postcode;
    private $city;
    private $countryCode;

    public function setUp()
    {
        $this->lat = 123;
        $this->lon = 80;
        $this->address = '1 Mountview, 128 Leigham Court Road';
        $this->postcode = 'SW16 2RN';
        $this->city = 'London';
        $this->countryCode = 'GB';
    }

    public function buildDomainObject()
    {
        return new Venues\Domain\Location(
            $this->lat,
            $this->lon,
            $this->address,
            $this->postcode,
            $this->city,
            $this->countryCode
        );
    }

    public function testCanConstruct()
    {
        $object = $this->buildDomainObject();

        $this->assertTrue($object instanceof Venues\Domain\Location);
    }

    public function testCanConstructWithNullValues()
    {
        $this->address = NULL;
        $this->postcode = NULL;
        $this->city = NULL;
        $this->countryCode = NULL;

        $object = $this->buildDomainObject();

        $this->assertTrue($object instanceof Venues\Domain\Location);
    }

    public function testCanConstructWithLowercaseCountryCode()
    {
        $this->countryCode = 'gb';

        $object = $this->buildDomainObject();

        $this->assertTrue($object instanceof Venues\Domain\Location);
    }

    public function testErrorOnNonNumericLatLon()
    {
        $this->setExpectedException('Venues\Error\BadParameter');

        $this->lat = 'lat';
        $this->lon = 'lon';

        $object = $this->buildDomainObject();
    }

    public function testErrorOnUnknownCountryCode()
    {
        $this->setExpectedException('Venues\Error\BadParameter');

        $this->countryCode = 'UK';

        $object = $this->buildDomainObject();
    }

    public function testGetDistanceTo()
    {
        $this->lat = 50;
        $this->lon = 50;

        $from = $this->buildDomainObject();

        $to = new Venues\Domain\Location(
            51,
            51
        );

        /*
         * According to: 
         *
         *     http://www.movable-type.co.uk/scripts/latlong.html
         *
         * The distance between 50,50 and 51,51 is 131.8 km.
         */

        $this->assertEquals(round($from->getDistanceTo($to)), 132);

        $this->assertEquals(
            $from->getDistanceTo($to),
            $to->getDistanceTo($from)
        );
    }
}
