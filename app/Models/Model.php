<?php

namespace App\Models;

/**
 * Class Model
 * @package App\Models
 */
abstract class Model
{
    protected array $fillable = [];

    /**
     * Model constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * @param array $attributes
     */
    public function fill(array $attributes): void
    {
        foreach ($this->fillable as $attribute) {
            if (false === isset($attributes[$attribute])) {
                continue;
            }

            $this->$attribute = $attributes[$attribute];
        }
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return $this
     */
    public function setAttribute(string $attribute, $value): self
    {
        $this->$attribute = $value;
        return $this;
    }
}
