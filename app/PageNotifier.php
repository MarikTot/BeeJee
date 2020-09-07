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

    private ?string $success = null;
    private ?string $error = null;

    /**
     * @param string $success
     */
    public function addSuccess(string $success): void
    {
        $this->success = $success;
        $this->addNotice(self::TYPE_SUCCESS, $success);
    }

    /**
     * @param string $error
     */
    public function addError(string $error): void
    {
        $this->error = $error;
        $this->addNotice(self::TYPE_ERROR, $error);
    }

    /**
     * @return string
     */
    public function getSuccess(): string
    {
        $notice = $this->success ?? $_COOKIE['success'] ?? '';

        $this->removeNotice(self::TYPE_SUCCESS);
        $this->success = '';

        return $notice;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        $notice = $this->error ?? $_COOKIE['error'] ?? '';

        $this->removeNotice(self::TYPE_ERROR);
        $this->error = '';

        return $notice;
    }

    /**
     * @param string $key
     * @param string $text
     */
    private function addNotice(string $key, string $text): void
    {
        setcookie($key, $text, time() + 10, Config::getInstance()->getBaseUrl());
    }

    /**
     * @param string $key
     */
    private function removeNotice(string $key = self::TYPE_SUCCESS): void
    {
        setcookie($key, '', time() - 3600, Config::getInstance()->getBaseUrl());
    }
}
