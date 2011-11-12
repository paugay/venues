<?php 

namespace Venues\Keyed;

/**
 * Keyed Object interface
 *
 * Represents any domain object that has a key to identify the object 
 * within the library.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

interface IKeyedObject
{
    /**
     * Get key
     *
     * @return Integer
     */
    public function getKey();
}
