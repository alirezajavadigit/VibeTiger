<?php
/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\System\Traits;

trait MethodCaller
{
    /**
     * Magic method to call instance methods dynamically.
     *
     * @param string $method The method name to call.
     * @param array $args An array of arguments to pass to the method.
     * @return mixed The result of the method call.
     */
    public function __call(string $method, array $args): mixed
    {
        // Call the methodCaller method of the current instance with provided arguments.
        return self::$instance->methodCaller(self::$instance, $method, $args);
    }

    /**
     * Magic method to call static methods dynamically.
     *
     * @param string $method The method name to call.
     * @param array $args An array of arguments to pass to the method.
     * @return mixed The result of the method call.
     */
    public static function __callStatic(string $method, array $args): mixed
    {
        // Call the methodCaller method of the current instance with provided arguments.
        return self::$instance->methodCaller(self::$instance, $method, $args);
    }

    /**
     * Calls a method dynamically.
     *
     * @param object $object The object to call the method on.
     * @param string $method The method name to call.
     * @param array $args An array of arguments to pass to the method.
     * @return mixed The result of the method call.
     */
    private function methodCaller($object, string $method, array $args): mixed
    {
        $suffix = 'set';
        $methodName = $suffix . strtoupper($method[0]) . substr($method, 1);
        // Call the method on the object with provided arguments.
        return call_user_func_array(array($object, $methodName), $args);
    }
}
