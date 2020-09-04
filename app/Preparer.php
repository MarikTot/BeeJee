<?php

namespace App;

use App\Exceptions\PreparerException;
use Exception;

/**
 * Class PrepareData
 * @package App
 */
final class Preparer extends Singleton
{
    /**
     * @param mixed $data
     * @return array|float|int|string
     * @throws Exception
     */
    public function prepare($data)
    {
        if (is_int($data)) {
            return $this->prepareInt($data);
        }

        if (is_float($data)) {
            return $this->prepareFloat($data);
        }

        if (is_bool($data)) {
            return $this->prepareBool($data);
        }

        if (is_string($data)) {
            return $this->prepareString($data);
        }

        if (is_array($data)) {
            $newArray = [];

            foreach ($data as $key => $item) {
                $newArray[$this->prepare($key)] = $this->prepare($item);
            }
            return $newArray;
        }

        throw new PreparerException('Wrong data format');
    }

    /**
     * @param int $number
     * @return int
     */
    private function prepareInt(int $number): int
    {
        return (int)$number;
    }

    /**
     * @param float $number
     * @return float
     */
    private function prepareFloat(float $number): float
    {
        return (float)$number;
    }

    /**
     * @param bool $data
     * @return float
     */
    private function prepareBool(bool $data): float
    {
        return (bool)$data;
    }

    /**
     * @param string $string
     * @return string
     */
    private function prepareString(string $string): string
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);

        return $string;
    }
}
