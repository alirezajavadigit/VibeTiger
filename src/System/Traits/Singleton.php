<?php
/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\System\Traits;

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
     * the class from outside the trait itself. This is commonly used in 
     * singleton patterns to ensure that only one instance of the class can exist.
     */
    private function __construct()
    {
        // Constructor intentionally left empty.
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
    public static function getInstance()
    {
        // If the instance does not exist, create a new one and assign it to $instance.
        return self::$instance ? self::$instance : self::$instance = new self();
    }
}
