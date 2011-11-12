<?php 

/**
 * Autoload
 *
 * This script will setup the autoloader for the project.
 *
 * @version     $Id$
 * @package     Venues
 * @author      Pau Gay <pau.gay@gmail.com> 
 */

spl_autoload_register(
    array(
        'Autoloader',
        'loadClass'
    )
);

class Autoloader
{
    public static function loadClass($className)
    {
        $parts = explode('\\', $className);

        // loose the "Venues" from the name
        array_shift($parts);

        include "lib/" . implode('/', $parts) . '.php';

        return TRUE;
    }
}

