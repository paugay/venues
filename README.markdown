# Purpose

This a personal challenge. The purpose of this library is to grab a set of venues 
for a given lat-lon polygon.

Initially it will grab the venues from Foursquare but later on I will try to grab 
venues from other places as well.

# Changelog

I will try to apply some DDD principles to this bit of library, starting from the 
beginning and keep adding features on top to try to continuously improve it.

I will be documenting all the changes that I'm doing to it in the following changelog.

## 2011-11-11 - v0.01

Done:

* Basic domain models Venue and Location. No persistence yet, just the basics.
* Unit test for both models (no capability to run them all together yet).
* Wrote a generic "Error\BadParameter" exception to start modeling the error handling.
* Small "sandbox" script to check that it is usable: php sandbox/test.php

Tag:
* v0.01

# Resources

1. [Algorism for calculate the distance between two locations](http://www.movable-type.co.uk/scripts/latlong.html)
2. [Syntax for this markdown text](http://daringfireball.net/projects/markdown/syntax)
