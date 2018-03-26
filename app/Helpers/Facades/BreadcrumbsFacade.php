<?php

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;
use App\Helpers\Breadcrumbs;

class BreadcrumbsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Breadcrumbs::class;
    }
}
