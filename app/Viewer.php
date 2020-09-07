<?php

namespace App;

use App\Exceptions\ViewerException;

/**
 * Class Viewer
 * @package App
 */
final class Viewer
{
    private const BASE_TEMPLATE = 'index';
    private const PAGINATOR_TEMPLATE = 'paginator';

    private string $template;

    /**
     * Viewer constructor.
     * @param string $template
     */
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param array $objects
     * @param string $title
     * @return string
     * @throws ViewerException
     */
    public function render(array $objects = [], string $title = ''): string
    {
        if (false === $this->templateIsExist($this->template)) {
            throw new ViewerException(sprintf('Template %s is not exist', $this->template));
        }

        ob_start();
        extract($objects);

        $title = $title !== '' ? $title : Config::getInstance()->getAppName();
        $template = $this->getFullTemplate($this->template);

        if ($this->templateIsExist(self::BASE_TEMPLATE) && self::PAGINATOR_TEMPLATE !== $this->template) {
            require $this->getFullTemplate(self::BASE_TEMPLATE);
        } else {
            require $template;
        }

        return ob_get_clean();
    }

    /**
     * @param string $template
     * @return string
     */
    private function getFullTemplate(string $template): string
    {
        return sprintf('../%s/%s.php', Config::getInstance()->getTemplatePath(), $template);
    }

    /**
     * @param string $template
     * @return bool
     */
    private function templateIsExist(string $template): bool
    {
        return file_exists($this->getFullTemplate($template));
    }
}
