<?php
/*
|--------------------------------------------------------------------------
| Created By Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\System\Traits\ORM;

trait SetAttributes
{
    /**
     * The "where" condition for the query.
     *
     * @var mixed The "where" condition for the query.
     */
    private $where;

    /**
     * The module associated with the attributes.
     *
     * @var mixed The module associated with the attributes.
     */
    private $module;

    /**
     * The HTTP verb associated with the attributes.
     *
     * @var string The HTTP verb associated with the attributes.
     */
    private $httpVerb;

    /**
     * Get the "where" condition for the query.
     *
     * @return mixed The "where" condition for the query.
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * Set the "where" condition for the query.
     *
     * @param mixed $where The "where" condition for the query.
     * @return $this This instance for method chaining.
     */
    public function setWhere($where)
    {
        $this->where = $where;

        return $this;
    }

    /**
     * Get the module associated with the attributes.
     *
     * @return mixed The module associated with the attributes.
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set the module associated with the attributes.
     *
     * @param mixed $module The module associated with the attributes.
     * @return $this This instance for method chaining.
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get the HTTP verb associated with the attributes.
     *
     * @return string The HTTP verb associated with the attributes.
     */
    public function getHttpVerb()
    {
        return $this->httpVerb;
    }

    /**
     * Set the HTTP verb associated with the attributes.
     *
     * @param string $httpVerb The HTTP verb associated with the attributes.
     * @return $this This instance for method chaining.
     */
    public function setHttpVerb($httpVerb)
    {
        $this->httpVerb = $httpVerb;

        return $this;
    }
}
