<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class News extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $news = \App\Models\Backend\News::where('public', 1)->latest()->limit(6)->get();

        return view('widgets.news', [
            'news' => $news
        ]);
    }
}
