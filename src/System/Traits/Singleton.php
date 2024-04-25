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
     * The singleton instance of the class.
     *
     * @var self|null The singleton instance of the class.
     */
    private static $instance = null;

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
        // If the instance does not exist, create a new one and assign it to $instance.
        return self::$instance ? self::$instance : self::$instance = new self();
    }
}
