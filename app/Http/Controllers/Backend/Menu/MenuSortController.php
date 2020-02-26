<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Models\Backend\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuSortController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->ajax()){

            $items = $request->get('items');

            Menu::rebuildTree($items);

            foreach($items as $key => $item){
                Menu::where('id', $item['id'])->update(['sort' => $key]);
                if(isset($item['children'])){
                    foreach($item['children'] as $key2 => $children){
                        Menu::where('id', $children['id'])->update(['sort' => $key2]);
                    }
                }
            }

            return response('Ok!', 200)->header('Content-Type', 'text/plain');

        }
    }
}
