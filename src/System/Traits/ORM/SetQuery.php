<?php

/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\System\Traits\ORM;


trait SetQuery
{
    /**
     * The last query executed.
     *
     * @var array The last query executed.
     */
    private array $lastQuery;

    /**
     * Set a POST request.
     *
     * @return mixed The result of the POST request.
     */
    private function setPost()
    {
        return self::$kernel->exec($this->lastQuery("post"));
    }

    /**
     * Set a GET request.
     *
     * @return mixed The result of the GET request.
     */
    private function setGet()
    {
        return self::$kernel->exec($this->lastQuery("get"));
    }

    /**
     * Get the SQL query.
     *
     * @return string The SQL query.
     */
    private function getSql()
    {
        $sql = "SELECT * FROM " . $this->getModule() . " ";
        if (!empty($this->getWhere())) {
            $sql .= "WHERE " . $this->getWhere();
        }
        return $sql  . ";";
    }

    /**
     * Get the second value based on operation.
     *
     * @return mixed|null The second value if operation is 'query', null otherwise.
     */
    private function secondValue()
    {
        if (strtolower($this->getOperation()) === "query") {
            return $this->getSql();
        }
        return null;
    }

    /**
     * Generate the last query based on HTTP verb.
     *
     * @param string $httpVerb The HTTP verb associated with the query.
     * @return array The last query.
     */
    private function lastQuery($httpVerb)
    {
        if (strtolower($this->getOperation()) === "query") {
            return [$this->getOperation(), ["query" => $this->getSql()], strtoupper($httpVerb)];
        } else {
            return [$this->getOperation(), [$this->getModule() === null ?: "elementType" => $this->getModule(), "element" => json_encode($this->getParams())], strtoupper($httpVerb)];
        }
    }
}
