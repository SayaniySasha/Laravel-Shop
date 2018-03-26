<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;


class PagesController extends Controller
{

    public function index($slug)
    {
        $content = Page::findBySlug($slug);

        $this->breadcrumbs
            ->addCrumb($slug, $slug);

        return view('frontend.page')->with('content', $content)->with('breadcrumbs', $this->breadcrumbs);

    }

}
