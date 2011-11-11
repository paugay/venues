<?php

namespace Venues;

class Venue
{
    protected $title;
    protected $location;

    public function __construct(
        $title,
        Location $location
    )
    {
        $this->title = $title;
        $this->location = $location;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
