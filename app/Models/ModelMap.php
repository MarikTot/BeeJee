<?php

namespace App\Models;

use App\DB;
use App\Exceptions\DbException;
use App\Exceptions\ModelException;

/**
 * Class ModelMap
 * @package App\Models
 */
abstract class ModelMap
{
    public static string $table;
    public static string $modelClass;

    private const DEFAULT_LIMIT = 1000;
    private const DEFAULT_ORDER = 'id';

    /**
     * @param string $orderBy
     * @param int $limit
     * @param int $offset
     * @return Model[]
     * @throws DbException
     */
    public function getList(string $orderBy = self::DEFAULT_ORDER, int $limit = self::DEFAULT_LIMIT, int $offset = 0): array
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM `%s` ORDER BY `%s` LIMIT %s OFFSET %s';

        $sql = sprintf($sql, static::$table, $orderBy, $limit, $offset);

        $list = $db->query($sql);

        $objectList = [];
        foreach ($list as $data) {
            $objectList[] = $this->createModelByDataWithId($data);
        }

        return $objectList;
    }

    /**
     * @param int $id
     * @return Model
     * @throws DbException|ModelException
     */
    public function getById(int $id): Model
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM `%s` WHERE `id` = %s';

        $sql = sprintf($sql, static::$table, $id);

        $result = $db->query($sql);

        if ([] === $result) {
            throw new ModelException('Model not found');
        }

        return $this->createModelByDataWithId($result[0]);
    }

    /**
     * @param Model $model
     * @return Model
     * @throws DbException
     * @throws ModelException
     */
    public function create(Model $model): Model
    {
        $parameters = get_object_vars($model);

        $db = DB::getInstance();

        $sql = 'INSERT INTO `%s` (%s) VALUES (%s)';

        $sql = sprintf($sql, static::$table, $this->fieldsToString(array_keys($parameters)), $this->valuesToString($parameters));

        $db->execute($sql);

        return $this->getById($db->lastInsertId());
    }

    /**
     * @param Model $model
     * @return Model
     * @throws DBException
     */
    public function update(Model $model): Model
    {
        $parameters = get_object_vars($model);

        // TODO: throw Exception
        $id = $parameters['id'];

        $db = DB::getInstance();

        $sql = 'UPDATE `%s` SET %s WHERE `id` = %s';

        $set = [];
        foreach ($parameters as $key => $value) {
            if ('id' === $key) {
                continue;
            }
            $set[] = sprintf('`%s` = \'%s\'', $key, $value);
        }

        $sql = sprintf($sql, static::$table, implode(', ', $set), $id);

        $db->execute($sql);

        return $model;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        // TODO:
    }

    /**
     * @return int
     * @throws DbException
     */
    public function count(): int
    {
        $db = DB::getInstance();

        $sql = 'SELECT count(`id`) as count FROM `%s`';

        $sql = sprintf($sql, static::$table);

        $result = $db->query($sql);

        return $result[0]['count'] ?? 0;
    }

    /**
     * @param array $data
     * @return Model
     */
    private function createModelByData(array $data): Model
    {
        /** @var Model $object */
        $object = new static::$modelClass;
        $object->fill($data);

        return $object;
    }

    /**
     * @param array $data
     * @return Model
     */
    private function createModelByDataWithId(array $data): Model
    {
        $object = $this->createModelByData($data);
        $object->setAttribute('id', $data['id']);
        return $object;
    }

    /**
     * @param array $fields
     * @return string
     */
    private function fieldsToString(array $fields): string
    {
        $fields = array_map(fn($field) => '`' . $field . '`', $fields);
        return implode(', ', $fields);
    }

    /**
     * @param array $values
     * @return string
     */
    private function valuesToString(array $values): string
    {
        $values = array_map(fn($value) => '\'' . $value . '\'', $values);
        return implode(', ', $values);
    }
}
