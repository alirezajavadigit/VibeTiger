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
     * The query associated with the attributes.
     *
     * @var string The query associated with the attributes.
     */
    private string $query;

    /**
     * Parameters associated with the attributes.
     *
     * @var array Parameters associated with the attributes.
     */
    private array $params;

    /**
     * The operation associated with the attributes.
     *
     * @var string The operation associated with the attributes.
     */
    private string $operation;

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
     * Get the query associated with the attributes.
     *
     * @return mixed The query associated with the attributes.
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set the query associated with the attributes.
     *
     * @param mixed $query The query to be associated with the attributes.
     * @return $this This instance for method chaining.
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the parameters associated with the attributes.
     *
     * @return array The parameters associated with the attributes.
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the parameters associated with the attributes.
     *
     * @param array $params The parameters to be associated with the attributes.
     * @return $this This instance for method chaining.
     */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get the operation associated with the attributes.
     *
     * @return string The operation associated with the attributes.
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set the operation associated with the attributes.
     *
     * @param string $operation The operation to be associated with the attributes.
     * @return $this This instance for method chaining.
     */
    public function setOperation(string $operation)
    {
        $this->operation = $operation;

        return $this;
    }
}
