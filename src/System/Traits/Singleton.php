<?php
/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\System\Traits;

use VibeTiger\System\Kernel;

trait Singleton
{
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
     * The singleton instance of the class.
     *
     * @var self|null The singleton instance of the class.
     */
    private static $instance = null;

    /**
     * Lock for thread safety.
     * 
     * @var mixed Lock for thread safety.
     */
    private static $lock = null;

    /**
     * Prevent instance from being cloned.
     */
    private function __clone()
    {
    }

    /**
     * Prevent instance from being unserialized.
     */
    private function __wakeup()
    {
    }

    /**
     * Private constructor to prevent instantiation from outside the class.
     * 
     * This constructor is declared as private to prevent the instantiation of 
     * the class from outside the class itself. It initializes the Kernel 
     * instance with the provided URL, username, and access key, and then logs 
     * in to the system.
     */
    private function __construct()
    {
        // Initialize lock
        if (is_null(self::$lock)) {
            self::$lock = new \stdClass();
        }
        // Initialize the Kernel instance with the provided URL, username, and access key.
        self::$kernel = new Kernel(self::$url, self::$username, self::$accessKey);

        // Log in to the system.
        self::$kernel->login();
    }

    /**
     * Get the singleton instance of the class.
     *
     * @return self The singleton instance of the class.
     * 
     * This method returns the singleton instance of the class. If the instance 
     * does not exist, it creates a new one and assigns it to the static 
     * property $instance. This ensures that only one instance of the class is 
     * created throughout the application's lifecycle.
     */
    public static function getInstance($url, $username, $accessKey)
    {
        self::$url = $url;
        self::$username = $username;
        self::$accessKey = $accessKey;
        if (is_null(self::$instance)) {
            // Thread-safe lazy initialization
            $lock = self::$lock; // to ensure thread safety
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
        }
        return self::$instance;
    }
}
