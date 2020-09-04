<?php

namespace App;

/**
 * Class Config
 * @package App
 */
final class Config extends Singleton
{
    private const DEFAULT_APP_NAME = 'BeeJee';
    private const DEFAULT_BASE_URL = '\/';
    private const DEFAULT_CONTROLLERS_NAMESPACE = '\\App\\Controllers\\';
    private const DEFAULT_TEMPLATES_PATH = 'views';

    private array $app = [];
    private array $database = [];

    /**
     * Config constructor.
     */
    protected function __construct()
    {
        parent::__construct();

        $this->app = require_once '../config/app.php';
        $this->database = require_once '../config/database.php';
    }

    /**
     * @return string
     */
    public function getAppName(): string
    {
        return $this->app['app_name'] ?? self::DEFAULT_APP_NAME;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->app['base_url'] ?? self::DEFAULT_BASE_URL;
    }

    /**
     * @return string
     */
    public function getControllersNamespace(): string
    {
        return $this->app['controllers_namespace'] ?? self::DEFAULT_CONTROLLERS_NAMESPACE;
    }

    /**
     * @return string
     */
    public function getTemplatePath(): string
    {
        return $this->app['templates_path'] ?? self::DEFAULT_TEMPLATES_PATH;
    }
}
