<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Backend\Menu as TopMenu;

class Menu extends AbstractWidget
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
        $items = TopMenu::orderBy('sort')->get()->toTree();

        return view('widgets.menu', [
            'config' => $this->config,
            'items' => $items
        ]);
    }
}
