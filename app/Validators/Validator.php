<?php

namespace App\Validators;

/**
 * Class Validator
 * @package App\Validators
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
     * @param array $parameters
     * @return array
     */
    abstract public function validate(array $parameters): array;

    /**
     * What happens if validation fail
     * @param array $parameters
     * @return  mixed
     */
    abstract public function fail(array $parameters);
}
