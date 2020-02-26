<?php

namespace App\Widgets;

use App\Models\Backend\FilterGroup;
use Arrilot\Widgets\AbstractWidget;

class Filter extends AbstractWidget
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
        $filterGroup = FilterGroup::with('filters')->get();

        return view('widgets.filter', compact('filterGroup'));
    }
}
