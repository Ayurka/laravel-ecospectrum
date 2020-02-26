<?php

namespace App\Widgets;

use App\Models\Backend\Category;
use Arrilot\Widgets\AbstractWidget;

class Categories extends AbstractWidget
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
        $categories = Category::where('public', 1)->with('url')->get()->toTree();

        return view('widgets.categories', compact('categories'));
    }
}
