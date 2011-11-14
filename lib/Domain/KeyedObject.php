<?php

namespace Venues\Domain;

/**
 * Keyed Object
 *
 * Represents any domain object that has a key to identify the object 
 * within the library.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

abstract class KeyedObject
    implements \Venues\Keyed\KeyedObjectInterface
{
    /**
     * Get key
     *
     * @return Integer
     */
    public function getKey()
    {
        return $this->key;
    }
}
