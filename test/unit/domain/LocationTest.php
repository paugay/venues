<?php

require_once "lib/domain/Location.php";

class LocationTest 
    extends \PHPUnit_Framework_TestCase
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
        return new \Venues\Domain\Location(
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

        $this->assertTrue($object instanceof \Venues\Domain\Location);
    }

    public function testErrorOnWrongCountryCode()
    {
        $this->setExpectedException('\Venues\Error\BadParameter');

        $this->countryCode = "UK";

        $object = $this->buildDomainObject();
    }
}
