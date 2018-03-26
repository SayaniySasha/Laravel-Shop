<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Contracts\PageContract;
use App\CustomPage;

class Page implements PageContract
{
    public static function findBySlug($slug)
    {
        return CustomPage::where('slug', $slug)->first();
    }
    
    public function getPage($page)
    {
        // TODO: Implement getPage() method.
    }
    
    public function setPage($platform, $page, $content)
    {
        // TODO: Implement setPage() method.
    }
}
