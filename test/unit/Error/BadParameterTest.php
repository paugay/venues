<?php

/**
 * Bad Parameter test
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class BadParameterTest
    extends PHPUnit_Framework_TestCase
{
    public function testCanConstruct()
    {
        $error = new Venues\Error\BadParameter();

        $this->assertInstanceOf('Exception', $error);
    }
}
