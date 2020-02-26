<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Requests\Backend\AttributeRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\CrudRepositoryInterface;

class AttributeController extends Controller
{
    protected $model;

    public function __construct(CrudRepositoryInterface $crud)
    {
        $this->model = $crud;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->model->all();
        return view('backend.catalog.attribute_form.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.catalog.attribute_form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AttributeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $group = $this->model->create($request->all());
        $this->model->createAttributes($request, $group->id);

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = $this->model->show($id);
        return view('backend.catalog.attribute_form.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttributeRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $this->model->update($request->all(), $id);
        $this->model->updateAttributes($request, $id);
        $this->model->createAttributes($request, $id);

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);

        return redirect()->route('admin.attribute.index')->with('flash_success', 'Группа атрибутов успешно удален');
    }
}
