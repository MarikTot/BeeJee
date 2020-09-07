<?php

namespace App;

/**
 * Class PageNotifier
 * @package App
 */
final class PageNotifier extends Singleton
{
    private const TYPE_SUCCESS = 'success';
    private const TYPE_ERROR = 'error';

    /**
     * @param string $success
     */
    public function addSuccess(string $success): void
    {
        $_SESSION[self::TYPE_SUCCESS] = $success;
    }

    /**
     * @param string $error
     */
    public function addError(string $error): void
    {
        $_SESSION[self::TYPE_ERROR] = $error;
    }

    /**
     * @return string
     */
    public function getSuccess(): string
    {
        $notice = $_SESSION[self::TYPE_SUCCESS] ?? '';
        unset($_SESSION[self::TYPE_SUCCESS]);
        return $notice;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        $notice = $_SESSION[self::TYPE_ERROR] ?? '';
        unset($_SESSION[self::TYPE_ERROR]);
        return $notice;
    }
}
