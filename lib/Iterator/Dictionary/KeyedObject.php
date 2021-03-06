<?php

namespace Venues\Iterator\Dictionary;

/**
 * Keyed Object iterator
 *
 * Represents a iterator that contains elements that have keys.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class KeyedObject
    extends DictionaryAbstract
    implements DictionaryInterface
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
