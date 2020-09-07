<?php

namespace App\Validators;

use App\Models\ModelMap;

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

        $orderType = $parameters['orderType'] ?? ModelMap::ORDER_TYPE_ASC;

        return [
            'page' => $page,
            'order' => $order,
            'orderType' => $orderType,
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
