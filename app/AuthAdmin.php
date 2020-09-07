<?php

namespace App;

/**
 * Class AuthAdmin
 * @package App
 */
final class AuthAdmin extends Singleton
{
    private const ONE_DAY_SEC = 86400;
    private const IS_ADMIN_COOKIE_NAME = 'is_admin';

    private const ADMIN_HASH_PASSWORD = '$2y$10$EaThLWBTNs04ufmG92oI9u/NMhCbWwMgbnn0hGqkk8AZYnd.4G5Hq';
    private const ADMIN_LOGIN = 'admin';

    /**
     * @param string $login
     * @param string $password
     */
    public function login(string $login, string $password): void
    {
        if (self::ADMIN_LOGIN === $login && $this->checkPassword($password)) {
            $this->setAdminCookie();
        }
    }

    /**
     *
     */
    public function logout(): void
    {
        setcookie(self::IS_ADMIN_COOKIE_NAME, 0, time() - 3600, Config::getInstance()->getBaseUrl() . '/');
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $_COOKIE[self::IS_ADMIN_COOKIE_NAME] ?? false;
    }

    /**
     * @param string $password
     * @return string
     */
    private function getHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @return bool
     */
    private function checkPassword(string $password): bool
    {
        return password_verify($password, self::ADMIN_HASH_PASSWORD);
    }

    /**
     *
     */
    private function setAdminCookie(): void
    {
        setcookie(self::IS_ADMIN_COOKIE_NAME, 1, time() + self::ONE_DAY_SEC, Config::getInstance()->getBaseUrl() . '/');
    }
}
