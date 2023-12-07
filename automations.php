<?php

/**
 * These are the events that Home Assistant throws and what classes/automations should be fired.
 * There are 2 ways to declare what needs to be run:
 * - the first is a simple key => value where the key is the event and the value is the automation class
 * - the second replaces the automation class with an array of automation classes
 * for example:
 * ['event.name' => Automation::class]
 * or
 * ['event.name' => [Automation1::class, Automation2::class]]
 */

return [
    //
];