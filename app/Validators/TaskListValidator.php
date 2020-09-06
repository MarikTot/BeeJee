<?php

namespace App\Validators;

/**
 * Class TaskListValidator
 * @package App\Validators
 */
final class TaskListValidator extends Validator
{
    /**
     * @param array $parameters
     * @return array
     */
    public function validate(array $parameters): array
    {
        $page = isset($parameters['page']) && $parameters['page'] > 0 ? (int)$parameters['page'] : 1;

        $availableOrders = ['id', 'user', 'email', 'completed_at'];
        $order = isset($parameters['order']) && in_array($parameters['order'], $availableOrders) ? $parameters['order'] : 'id';

        return [
            'page' => $page,
            'order' => $order,
        ];
    }

    /**
     * @param array $parameters
     */
    public function fail(array $parameters)
    {
        // Nothing
    }
}
