<?php

namespace Venues\Iterator\Dictionary;

/**
 * Keyed Object iterator
 *
 * Represents a iterator of a objects that have keys.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class KeyedObject
    extends \Dictionary
    implements IDictionary
{
    /**
     * Generate hash
     *
     * Methor that return the hash of the item.
     *
     * @param Mixed $item
     *
     * @return String
     */
    public function generateHash($item)
    {
        return $item->getKey();
    }
}
