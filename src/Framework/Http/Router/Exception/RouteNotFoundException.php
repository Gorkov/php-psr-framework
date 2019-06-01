<?php

namespace Framework\Http\Router\Exception;

class RouteNotFoundException extends \LogicException
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $params;

    /**
     * RouteNotFoundException constructor.
     *
     * @param string $name
     * @param array  $params
     */
    public function __construct(string $name, array $params)
    {
        parent::__construct('Route "' . $name . '" not found.');
        $this->name = $name;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
