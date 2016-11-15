<?php
namespace Application\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class PaginatorHelper extends AbstractHelper
{
    private $resultsPerPage;
    private $totalResults;
    private $results;
    private $baseUrl;
    private $paging;
    private $page;

    public function __invoke($pagedResults, $page, $baseUrl, $resultsPerPage=10)
    {
        $this->resultsPerPage = $resultsPerPage;
        $this->totalResults = $pagedResults->count();
        $this->results = $pagedResults;
        $this->baseUrl = $baseUrl;
        $this->page = $page;

        return $this->generatePaging();
    }

    /**
     * Generate paging html
     */
    private function generatePaging()
    {
        # Get total page count
        $pages = ceil($this->totalResults / $this->resultsPerPage);



        # Don't show pagination if there's only one page
        if($pages == 1)
        {
            return;
        }

        if($this->page != 1)
        {

            $this->paging .= '
            <li>
              <a href="'.$this->baseUrl.'/1" aria-label="First">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>';
        }

        $pageCount = 1;
        while($pageCount <= $pages)
        {
            $this->paging .= '<li><a href="'.$this->baseUrl.'/'.$pageCount.'">'.$pageCount.'</a></li>';
            $pageCount++;
        }

        if($this->page != $pages)
        {
            $this->paging .= '
            <li>
              <a href="'.$this->baseUrl.'/'.$pages.'" aria-label="Last">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>';
        }


        return $this->paging;
    }
}