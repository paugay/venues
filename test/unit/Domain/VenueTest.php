<?php

/**
 * Venue test
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class VenueTest 
    extends PHPUnit_Framework_TestCase
{
    private $key;
    private $title;
    private $location;

    public function setUp()
    {
        $this->key = 123;
        $this->title = 'test';
        $this->location = $this->getMock(
            'Venues\Domain\Location', 
            array(), 
            array(), 
            '', 
            FALSE // not call the constructor
        );
    }

    public function buildDomainObject()
    {
        return new Venues\Domain\Venue(
            $this->key,
            $this->title,
            $this->location
        );
    }

    public function testCanConstruct()
    {
        $object = $this->buildDomainObject();

        $this->assertTrue($object instanceof Venues\Domain\Venue);
    }

    public function testErrorOnInvalidKey()
    {
        $this->setExpectedException('Venues\Error\BadParameter');

        $this->key = "asd";

        $object = $this->buildDomainObject();
    }

    public function provideInvalidTitles()
    {
        return array(
            array(''),
            array('0'),
            array(0),
            array(FALSE)
        );
    }

    public function testGetters()
    {
        $object = $this->buildDomainObject();

        $this->assertEquals($object->getKey(), $this->key);
        $this->assertEquals($object->getTitle(), $this->title);
        $this->assertEquals($object->getLocation(), $this->location);
    }

    /**
     * @dataProvider provideInvalidTitles
     */
    public function testErrorOnInvalidTitle($title)
    {
        $this->setExpectedException('Venues\Error\BadParameter');

        $this->title = $title;

        $object = $this->buildDomainObject();
    }

    public function testGetDistance()
    {
        $venue = $this->buildDomainObject();

        $location = $this->getMock(
            'Venues\Domain\Location', 
            array(), 
            array(), 
            '', 
            FALSE // not call the constructor
        );

        $this->location->expects($this->once())
            ->method('getDistanceTo')
            ->with($location)
            ->will($this->returnValue(132));

        $this->assertEquals(round($venue->getDistanceTo($location)), 132);
    }
}
