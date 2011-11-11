<?php

namespace Venues\Error;

class BadParameter 
    extends \Exception
{
    public function getExitCode()
    {
        return 111;
    }
}
