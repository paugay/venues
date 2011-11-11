<?php

namespace Venues;

require_once "lib/domain/Venue.php";

class VenueTest 
    extends \PHPUnit_Framework_TestCase
{
    private $title;
    private $location;

    public function setUp()
    {
        $this->title = 'test';
        $this->location = $this->getMock('Venues\Location');
    }

    public function buildDomainObject()
    {
        return new Venue(
            $this->title,
            $this->location
        );
    }

    public function testCanConstruct()
    {
        $object = $this->buildDomainObject();

        $this->assertTrue($object instanceof Venue);
    }
}
