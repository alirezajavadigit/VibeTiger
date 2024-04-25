<?php
/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\App;

use VibeTiger\System\Traits\MethodCaller;
use VibeTiger\System\Traits\Singleton;

class CRM
{
    use MethodCaller, Singleton;

    /**
     * The URL for accessing the CRM system.
     *
     * @var string|null The URL for accessing the CRM system.
     */
    private static $url;

    /**
     * The username for authentication.
     *
     * @var string|null The username for authentication.
     */
    private static $username;

    /**
     * The access key for authentication.
     *
     * @var string|null The access key for authentication.
     */
    private static $accessKey;

    /**
     * The kernel instance for interacting with the CRM system.
     *
     * @var Kernel|null The kernel instance for interacting with the CRM system.
     */
    private static $kernel;
}
