<?php

namespace App\Middlewares;

/**
 * Class Validator
 * @package App\Middlewares
 */
abstract class Validator
{
    protected array $errors = [];

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $key
     * @param string $error
     */
    public function addError(string $key, string $error): void
    {
        $this->errors[$key] = $error;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return [] === $this->errors();
    }

    /**
     * What happens if validation fail
     */
    abstract public function fail();

    /**
     * @param array $parameters
     */
    abstract public function validate(array $parameters);

    /**
     * @return array
     */
    abstract public function validParameters(): array;
}
