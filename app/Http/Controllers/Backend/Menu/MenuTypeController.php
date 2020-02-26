<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Models\Backend\Category;
use App\Models\Backend\Page;
use App\Models\Backend\PageCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuTypeController extends Controller
{
    protected $items = false;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $typeMenu = $request->get('type_menu');

            switch ($typeMenu){
                case 'page': $this->items = Page::all();break;
                case 'pageCategory': $this->items = PageCategory::all();break;
                case 'categoryProduct': $this->items = Category::all();break;
                case 'catalog': $this->items = 'catalog';break;
                case 'contact': $this->items = 'contact';break;
                case 'link': $this->items = 'link';break;
            }

            $form = view('backend.menu.typeMenu', ['items' => $this->items])->render();

            return response()->json([
                'form' => $form,
                'status' => 'success',
            ]);
        }
        return abort(500);
    }
}
