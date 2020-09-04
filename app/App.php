<?php

namespace App;

/**
 * Class App
 * @package App
 */
final class App extends Singleton
{
    private Router $router;

    /**
     * App constructor.
     */
    protected function __construct()
    {
        parent::__construct();

        $this->router = new Router();
    }

    /**
     * @return Router
     */
    public function router(): Router
    {
        return $this->router;
    }

    /**
     *
     */
    public function run(): void
    {
    }
}
