<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ArticleRepository.
 *
 */


interface ArticlesRepository
{
    public function search(string $query = ""): Collection;
}
