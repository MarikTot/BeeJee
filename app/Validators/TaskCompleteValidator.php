<?php

namespace App\Validators;

use App\Services\TaskService;

/**
 * Class TaskCompleteValidator
 * @package App\Validators
 */
final class TaskCompleteValidator extends Validator
{
    /**
     * @param array $parameters
     * @return array
     */
    public function validate(array $parameters): array
    {
        if (empty($parameters['id'])) {
            $this->addError('id', 'Id is empty');
        }

        $taskService = new TaskService();
        try {
            $taskService->getById($parameters['id']);
        } catch (\Exception $e) {
            $this->addError('id', 'Id is not exist');
        }

        return $parameters;
    }

    /**
     * @param array $parameters
     * @return void|mixed
     */
    public function fail(array $parameters)
    {
        redirect('/');
    }
}
