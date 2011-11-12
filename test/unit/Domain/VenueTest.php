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
    private $title;
    private $location;

    public function setUp()
    {
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
            $this->title,
            $this->location
        );
    }

    public function testCanConstruct()
    {
        $object = $this->buildDomainObject();

        $this->assertTrue($object instanceof Venues\Domain\Venue);
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

    /**
     * @dataProvider provideInvalidTitles
     */
    public function testErrorOnInvalidTitle($title)
    {
        $this->setExpectedException('Venues\Error\BadParameter');

        $this->title = $title;

        $object = $this->buildDomainObject();
    }
}
