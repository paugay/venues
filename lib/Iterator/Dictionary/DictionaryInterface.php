<?php

namespace Venues\Iterator\Dictionary;

/**
 * Dictionary interface
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

interface DictionaryInterface
    extends \Venues\Iterator\IteratorInterface
{
    /**
     * Add 
     *
     * Method that add or update the iterator item with this value. Will 
     * add or overwrite the item with the same hash.
     *
     * @param Mixed $item
     */
    public function add($item);

    /**
     * Remove
     *
     * Method that remove the item from the iterator.
     *
     * @param Mixed $item
     */
    public function remove($item);
    
    /**
     * Find
     *
     * Method that search for a concrete key into the iterator. If 
     * found, it will return the item, NULL otherwise.
     *
     * @param String|Integer The key of the item
     *
     * @return Mixed|NULL
     */
    public function find($key);

    /**
     * Get keys
     *
     * Method that return the keys of the items form the iterator.
     *
     * @return Array
     */
    public function getKeys();
}
