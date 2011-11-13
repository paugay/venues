<?php

/**
 * Location list test
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class LocationListTest
    extends PHPUnit_Framework_TestCase
{
    public function buildDomainObject()
    {
        return new Venues\Domain\Location\LocationList();
    }

    public function testCanConstruct()
    {
        $list = $this->buildDomainObject();

        $this->assertInstanceOf('Venues\Domain\Location\LocationList', $list);
    }

    public function testAdd()
    {
        $list = $this->buildDomainObject();

        $location = $this->getMock(
            'Venues\Domain\Location', 
            array(), 
            array(), 
            '', 
            FALSE // not call the constructor
        );

        $list->add($location);
    }

    public function testErrorOnWrongTypeOfObject()
    {
        $this->setExpectedException('Venues\Error\BadParameter');

        $list = $this->buildDomainObject();

        $venue = $this->getMock('Venues\Domain\Venue', 
            array(), 
            array(), 
            '', 
            FALSE // not call the constructor
        );

        $list->add($venue);
    }
}
