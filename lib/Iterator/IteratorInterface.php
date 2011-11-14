<?php

namespace Venues\Iterator;

/**
 * Iterator Interface
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

interface IteratorInterface
    extends \Iterator, \Countable
{
    /**
     * Reset the array of items deleting it's content and pointing to 
     * the begining.
     */
    public function reset();

    /**
     * Advances array's internal pointer to the last element, and 
     * returns its value.
     *
     * @return Mixed
     */
    public function end();

    /**
     * Shuffle the items of the array
     *
     * @return Boolean
     */
    public function shuffle();
}
