<?php
/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\App;

use VibeTiger\System\Traits\MethodCaller;
use VibeTiger\System\Traits\ORM\SetAttributes;
use VibeTiger\System\Traits\ORM\SetQuery;
use VibeTiger\System\Traits\Singleton;

class CRM
{
    use MethodCaller, Singleton, SetAttributes, SetQuery;

    /**
     * The kernel instance for interacting with the CRM system.
     *
     * @var Kernel|null The kernel instance for interacting with the CRM system.
     */
    private static $kernel;
}
