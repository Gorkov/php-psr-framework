<?php

namespace Framework\Http\Router;

class Result
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $handler;

    /**
     * @var array
     */
    private $attributes;

    /**
     * Result constructor.
     *
     * @param string $name
     * @param mixed  $handler
     * @param array  $attributes
     */
    public function __construct(string $name, $handler, array $attributes)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
