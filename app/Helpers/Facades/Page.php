<?php
/**

*/

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;
use App\Helpers\Contracts\PageContract;

class Page extends Facade {

    protected static function getFacadeAccessor()
    {
        return PageContract::class;
    }
}
