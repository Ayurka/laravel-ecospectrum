<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Models\Backend\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Attribute::destroy($request->get('id'));

        return response()->json([
            'status' => 'success',
        ]);
    }
}
