<?php

namespace App\Validators;

use App\Services\TaskService;

/**
 * Class TaskUpdateValidator
 * @package App\Validators
 */
final class TaskUpdateValidator extends Validator
{
    /**
     * @param array $parameters
     * @return string[]
     */
    public function validate(array $parameters): array
    {
        $id = $parameters['id'] ?? 0;
        if (empty($id)) {
            $this->addError('id', 'Id is empty');
        }

        $text = $parameters['text'] ?? '';
        if (empty($text)) {
            $this->addError('text', 'Text is empty');
        }

        // We can update only text
        return [
            'id' => $id,
            'text' => $text,
        ];
    }

    /**
     * @param array $parameters
     * @return string
     */
    public function fail(array $parameters)
    {
        try {
            $taskService = new TaskService();
            $task = $taskService->getById($parameters['id'] ?? 0);

            return view('tasks/update', [
                'task' => get_object_vars($task),
                'errors' => $this->errors(),
            ]);
        } catch (\Exception $e) {
            redirect('/');
        }
    }
}
