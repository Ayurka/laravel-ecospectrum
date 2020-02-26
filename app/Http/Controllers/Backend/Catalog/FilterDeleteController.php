<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Models\Backend\Filter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Filter::destroy($request->get('id'));

        return response()->json([
            'status' => 'success',
        ]);
    }
}
