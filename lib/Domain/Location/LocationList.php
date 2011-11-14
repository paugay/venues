<?php

namespace Venues\Domain\Location;

/**
 * Location list
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class LocationList
    extends \Venues\Iterator\Dictionary\ValueObject
    implements \Venues\Iterator\Dictionary\DictionaryInterface
{
    /**
     * Add
     *
     * Method that adds a new Location object into the list.
     *
     * @throws Venues\Error\BadParameter If item is not a instance of 
     *     Location.
     *
     * @param Location $item
     */
    public function add($item)
    {
        if (!$item instanceof \Venues\Domain\Location)
        {
            throw new \Venues\Error\BadParameter();
        }

        parent::add($item);
    }
}
