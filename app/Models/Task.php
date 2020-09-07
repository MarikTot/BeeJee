<?php

namespace App\Models;

/**
 * Class Task
 * @package App\Models
 */
final class Task extends Model
{
    protected array $fillable = ['user', 'email', 'text', 'updated_at', 'completed_at', ];
}
