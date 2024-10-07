<?php 

namespace Src\Database; 

class Pagination {
    private int $currentPage = 1;
    private int $totalPages;
    private int $linksPerPage = 5;
    private int $itemsPerPage = 10;
    private int $totalItems;
    private string $pageIdentifier = 'page';

    public function setTotalItems(int $totalItems): void
    {
        $this->totalItems = $totalItems;
    }

    public function setPageIdentifier(string $identifier): void
    {
        $this->pageIdentifier = $identifier;
    }

    public function setItemsPerPage(int $itemsPerPage): void
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getTotal(): int 
    {
        return $this->totalItems;
    }

    public function getPerPage(): int 
    {
        return $this->itemsPerPage;
    }

    private function calculations(): string
    {
        $this->currentPage = $_GET['page'] ?? 1;

        $offset = ($this->currentPage - 1) * $this->itemsPerPage;

        $this->totalPages  = ceil($this->totalItems / $this->itemsPerPage);

        return "limit {$this->itemsPerPage} offset {$offset}";
    }

    public function dump(): string
    {
        return $this->calculations();
    }

    public function links(): string
    {
        $links = "<ul class='pagination'>";

        if ($this->currentPage > 1) {
            $previous = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $previous]));
            $first = http_build_query(array_merge($_GET, [$this->pageIdentifier => 1]));
            $links.= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Anterior</a></li>";
            $links.= "<li class='page-item'><a href='?{$first}' class='page-link'>Primeira</a></li>";
        }


        // 3 - 5 =     7 + 5 = 12
        for ($i=$this->currentPage - $this->linksPerPage; $i <=$this->currentPage + $this->linksPerPage ; $i++) {
            if ($i > 0 && $i <= $this->totalPages) {
                $class = $this->currentPage === $i ? 'active' : '';
                $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $i]));
                $links.="<li class='page-item {$class}'><a href='?{$linkPage}' class='page-link'>{$i}</a></li>";
            }
        }


        if ($this->currentPage < $this->totalPages) {
            $next = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $next]));
            $last = http_build_query(array_merge($_GET, [$this->pageIdentifier => $this->totalPages]));
            $links.= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Próxima</a></li>";
            $links.= "<li class='page-item'><a href='?{$last}' class='page-link'>Última</a></li>";
        }

        $links.="</ul>";

        return $links;
    }
}