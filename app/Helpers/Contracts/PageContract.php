<?php

namespace App\Helpers\Contracts;

interface PageContract
{
    public function getPage($page);
    public function setPage($platform, $page, $content);
    public static function findBySlug($slug);
}
