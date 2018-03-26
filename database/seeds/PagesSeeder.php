<?php

use Illuminate\Database\Seeder;
use App\CustomPage;
use Illuminate\Database\Eloquent\Model;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        CustomPage::create(
            [
            'title' => 'about',
            'slug' => 'about',
            'content' => 'About Page content',
            'page' => 'about',
            'key' => 'about',
            'description' => 'About Page',
            'tags' => 'page custom',
            ]
        );

        CustomPage::create(
            [
            'title' => 'gallery',
            'slug' => 'gallery',
            'content' => 'Gallery Page content',
            'page' => 'gallery',
            'key' => 'gallery',
            'description' => 'Gallery Page',
            'tags' => 'page gallery',
            ]
        );

    }
}
