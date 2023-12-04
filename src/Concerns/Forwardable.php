<?php

namespace Mpietrucha\Support\Concerns;

use Mpietrucha\Support\Forward;

trait Forwardable
{
    protected ?Forward $forward = null;

    public function __call(string $method, array $arguments): mixed
    {
        return $this->forward()->call($method, ...$arguments);
    }

    protected function forward(): Forward
    {
        return $this->forward ??= Forward::create(fn () => $this);
    }
}
