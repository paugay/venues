<?php

namespace Venues\Iterator\Dictionary;

/**
 * Value Object iterator
 *
 * Represents a iterator that contains elements that DON'T have keys.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

class ValueObject
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
        return md5(serialize($item));
    }
}
