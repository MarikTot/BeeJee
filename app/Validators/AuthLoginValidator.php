<?php

namespace App\Validators;
use App\AuthAdmin;
use App\Exceptions\ViewerException;
use App\PageNotifier;

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

        if (false === AuthAdmin::getInstance()->check($parameters['login'], $parameters['password'])
            && false === empty($parameters['login'])
            && false === empty($parameters['password'])
        ) {
            $this->addError('login', 'Check correctness');
            $this->addError('password', 'Check correctness');

            PageNotifier::getInstance()->addError('Incorrect login or password');
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
