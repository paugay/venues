<?php

namespace Venues\Iterator\Dictionary;

/**
 * Dictionary abstract
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

abstract class DictionaryAbstract
    extends \Venues\Iterator\IteratorAbstract
    implements DictionaryInterface
{
    /**
     * Add 
     *
     * Method that add or update the iterator item with this value. Will 
     * add or overwrite the item with the same hash.
     *
     * @param Mixed $item
     */
    public function add($item)
    {
        $hash = $this->generateHash($item);
        $this->items[$hash] = $item;
    }

    /**
     * Remove
     *
     * Method that remove the item from the iterator.
     *
     * @param Mixed $item
     */
    public function remove($item)
    {
        $hash = $this->generateHash($item);

        if (isset($this->items[$hash]))
        {
            unset($this->items[$hash]);
        }
    }
    
    /**
     * Find
     *
     * Method that search for a concrete key into the iterator. If 
     * found, it will return the item, NULL otherwise.
     *
     * @param String The key of the item
     *
     * @return Mixed|NULL
     */
    public function find($key)
    {
        return (isset($this->items[$key])) ? $this->items[$key] : NULL;
    }

    /**
     * Get keys
     *
     * Method that return the keys of the items form the iterator.
     *
     * @return Array
     */
    public function getKeys()
    {
        return array_keys($this->items);
    }

    /**
     * Generate hash
     *
     * Methor that return the hash of the item.
     *
     * @param Mixed $item
     *
     * @return String
     */
    abstract public function generateHash($item);
}
