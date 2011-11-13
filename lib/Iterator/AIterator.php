<?php

namespace Venues\Iterator;

/**
 * Iterator abstract
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

abstract class AIterator
    implements IIterator
{
    /**
     * Items
     *
     * @var Array
     */
    protected $items;

    /**
     * Return the current element
     *
     * @return Mixed
     */
    public function current()
    {
        return current($this->items);
    }

    /**
     * Return the key of the current element
     *
     * @return Integer
     */
    public function key()
    {
        return key($this->items);
    }


    /**
     * Move forward to next element
     */
    public function next()
    {
        next($this->items);
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind()
    {
        reset($this->items);
    }

    /**
     * Checks if current position is valid
     *
     * @return Boolean
     */
    public function valid()
    {
        return (current($this->items) === FALSE) ? FALSE : TRUE;
    }

    /**
     * Count elements of an object
     *
     * @return Integer
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Reset the array of items deleting it's content and pointing to 
     * the begining.
     */
    public function reset()
    {
        $this->items = array();
        $this->rewind();
    }

    /**
     * Advances array's internal pointer to the last element, and 
     * returns its value.
     *
     * @return Mixed
     */
    public function end()
    {
        return end($this->items);
    }

    /**
     * Shuffle the items of the array
     *
     * @return Boolean
     */
    public function shuffle()
    {
        // shuffle persevering keys
        $keys = array_keys($this->items); 
        shuffle($keys); 
        $this->items = array_merge(array_flip($keys), $this->items); 
    }
}
