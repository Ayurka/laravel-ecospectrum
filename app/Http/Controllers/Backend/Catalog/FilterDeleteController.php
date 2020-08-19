<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Models\Backend\Filter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterDeleteController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id)
    {
        Filter::destroy($id);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
