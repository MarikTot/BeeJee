<?php

namespace App\Validators;

use App\Exceptions\ViewerException;

/**
 * Class TaskCreateValidator
 * @package App\Validators
 */
final class TaskCreateValidator extends Validator
{
    /**
     * @param array $parameters
     * @return string[]
     */
    public function validate(array $parameters): array
    {
        $user = $parameters['user'] ?? '';
        $email = $parameters['email'] ?? '';
        $text = $parameters['text'] ?? '';

        $this->validateUser($user);
        $this->validateEmail($email);
        $this->validateText($text);

        return [
            'user' => $user,
            'email' => $email,
            'text' => $text,
        ];
    }

    /**
     * @param array $parameters
     * @return string
     * @throws ViewerException
     */
    public function fail(array $parameters)
    {
        return view('tasks/create', [
            'task' => $parameters,
            'errors' => $this->errors(),
        ]);
    }

    /**
     * @param string $user
     */
    private function validateUser(string $user): void
    {
        if (strlen($user) < 3) {
            $this->addError('user', 'User must be longer than 3 characters');
        }
    }

    /**
     * @param string $email
     */
    protected function validateEmail(string $email): void
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (false === $email) {
            $this->addError('email', 'Email is not valid');
        }
    }

    /**
     * @param string $text
     */
    private function validateText(string $text): void
    {
        if ('' === $text) {
            $this->addError('text', 'Text is empty');
        }
    }
}
