<?php
/**
 * File : Pagination.php
 * Created by PhpStorm
 * User: christos
 * Date: 2019-08-11
 * Time: 01:03
 * Copyright 2019, christos, All rights reserved
 */
declare( strict_types=1 );

require_once "init.php";

class Pagination extends Db_object
{
    /**
     * @var int
     */
    public $current_page, $items_per_page, $items_total_count;


    public function __construct($page = 1, $items_per_page = 8, $items_total_count = 0)
    {
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$items_per_page;
        $this->items_total_count = (int)$items_total_count;
    }

    public function has_previous()
    {
        return $this->previous() >= 1 ? true : false;
    }

    public function previous()
    {
        return $this->current_page - 1;
    }

    public function has_next()
    {
        return $this->next() <= $this->total_pages() ? true : false;
    }

    public function next()
    {
        return $this->current_page + 1;
    }

    public function total_pages()
    {
        return ceil($this->items_total_count / $this->items_per_page);
    }

    public function offset()
    {
        return ( $this->current_page - 1 ) * $this->items_per_page;
    }

}

