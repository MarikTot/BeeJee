<?php

namespace App;

use App\Exceptions\ViewerException;

/**
 * Class Paginator
 * @package App
 */
final class Paginator
{
    private int $currentPage;
    private int $totalPages;
    private string $linkPattern;

    private array $links;

    /**
     * Paginator constructor.
     * @param int $currentPage
     * @param int $totalPages
     * @param string $linkPattern
     */
    public function __construct(int $currentPage, int $totalPages, string $linkPattern = '/:page')
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->linkPattern = $linkPattern;

        $this->generateLinks();
    }

    /**
     * @return string
     * @throws ViewerException
     */
    public function paginate(): string
    {
        return view('paginator', ['links' => $this->links]);
    }

    /**
     *
     */
    private function generateLinks(): void
    {
        for ($page = 1; $page <= $this->totalPages; $page++) {
            $this->links[$page] = [
                'active' => $page !== $this->currentPage,
                'link' => $this->getLinkToPage($page),
            ];
        }
    }

    /**
     * @param int $page
     * @return string
     */
    private function getLinkToPage(int $page): string
    {
        return str_replace(':page', $page, $this->linkPattern);
    }
}
