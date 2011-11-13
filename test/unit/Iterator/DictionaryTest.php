<?php

/**
 * Dictionary test
 *
 * This test is going to test both the dictionary and the iterator 
 * abstract.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class DictionaryTest
    extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function buildDomainObject()
    {
        return new Venues\Iterator\Dictionary();
    }

    public function testCanConstruct()
    {
        $dic = $this->buildDomainObject();

        $this->assertTrue($dic instanceof Venues\Iterator\Dictionary);
    }

    public function testAddElement()
    {
        $dic = $this->buildDomainObject();

        $dic->add(1);
        $this->assertEquals($dic->count(), 1);

        $dic->add(2);
        $this->assertEquals($dic->count(), 2);

        // repeat the same element, it should not add a new one because 
        // there is already there
        $dic->add(2);
        $this->assertEquals($dic->count(), 2);
    }

    public function testRemoveElement()
    {
        $dic = $this->buildDomainObject();

        $dic->add(1);
        $dic->add(2);
        $this->assertEquals($dic->count(), 2);

        $dic->remove(2);
        $this->assertEquals($dic->count(), 1);
    }

    public function testGetKeysAndFindElement()
    {
        $dic = $this->buildDomainObject();

        $elements = array(
            1, 
            2
        );

        $md5 = array(
            md5(serialize(1)),
            md5(serialize(2))
        );

        foreach ($elements as $element)
        {
            $dic->add($element);
        }

        $this->assertEquals($md5, $dic->getKeys());

        foreach ($md5 as $key => $value)
        {
            $this->assertEquals($dic->find($value), $elements[$key]);
        }
    }

    public function testIterator()
    {
        $dic = $this->buildDomainObject();

        $array = array();

        // add elements
        for ($i = 0; $i < 10; $i++)
        {
            $array[] = $i;
            $dic->add($i);
        }

        // test count
        $this->assertEquals($dic->count(), $i);

        $i = 0;
        // test the iteration: current, key, next, rewind and valid
        foreach ($dic as $key => $element)
        {
            $this->assertEquals($element, $array[$i]);
            $i++;
        }

        // test end
        $this->assertEquals($dic->end(), end($array));

        $keysBefore = $dic->getKeys();
        $dic->shuffle();
        $keysAfter = $dic->getKeys();

        // check that keys before are different than keys after
        $this->assertNotEquals($keysBefore, $keysAfter);

        sort($keysBefore);
        sort($keysAfter);

        // and check that once sorted both keys are equal again
        $this->assertEquals($keysBefore, $keysAfter);

        // test reset
        $dic->reset();
        $this->assertEquals($dic->count(), 0);
    }
}
