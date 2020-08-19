<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Backend\FilterGroup;
use Illuminate\Http\Request;

class FilterGroupDeleteController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id)
    {
        FilterGroup::destroy($id);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
