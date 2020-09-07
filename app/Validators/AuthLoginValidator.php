<?php

namespace App\Validators;
use App\Exceptions\ViewerException;

/**
 * Class AuthLoginValidator
 * @package App\Validators
 */
final class AuthLoginValidator extends Validator
{
    /**
     * @param array $parameters
     * @return array
     */
    public function validate(array $parameters): array
    {
        if (empty($parameters['login'])) {
            $this->addError('login', 'Login is empty');
        }

        if (empty($parameters['password'])) {
            $this->addError('password', 'Password is empty');
        }

        return $parameters;
    }

    /**
     * @param array $parameters
     * @return string
     * @throws ViewerException
     */
    public function fail(array $parameters)
    {
        return view('login', [
            'auth' => $parameters,
            'errors' => $this->errors(),
        ]);
    }
}
