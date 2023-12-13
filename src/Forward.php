<?php

namespace Mpietrucha\Support;

use Closure;

class Forward extends Instance
{
    public function __construct(protected Closure $parent)
    {
        parent::__construct();
    }

    public function call(string $method, mixed ...$arguments): mixed
    {
        $instance = $this->get();

        if ($this->wasPreviouslyFailed()) {
            return $instance;
        }

        return Rescue::create($instance->$method(...))->errorable($this)(...$arguments);
    }
}
