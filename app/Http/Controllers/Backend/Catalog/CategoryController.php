<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Requests\Backend\CategoryRequest;
use App\Repositories\Backend\CrudRepositoryInterface;
use App\Services\ImageService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
        $categories = $this->model->paginate(15);

        return view('backend.catalog.category_form.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryTree = $this->model->getCategoryTree();
        $dataSelect = $this->model->getAllFilters()->content();

        return view('backend.catalog.category_form.create', compact('categoryTree', 'dataSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, ImageService $image)
    {
        $model = $this->model->create($request->all());

        $model->url()->create(['url' => $model->getUrl()]);

        $image->setImages($model, $request);

        $model->getPivotFilters()->sync($request->get('filters'));

        return redirect()->route('admin.category.index')->with('flash_success', 'Категория успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ImageService $image)
    {
        $category = $this->model->show($id);
        $categoryTree = $this->model->getCategoryTree();

        $dataSelect = $this->model->getDataSelect($category)->content();

        $preview = $image->getConfigImages($category->images);

        return view('backend.catalog.category_form.edit', compact('category','categoryTree', 'dataSelect', 'preview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param  int  $id
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, ImageService $image)
    {
        $model = $this->model->update($request->all(), $id);

        $model->url()->update(['url' => $model->getUrl()]);

        $image->setImages($model, $request);

        $model->getPivotFilters()->sync($request->get('filters'));

        return redirect()->route('admin.category.index')->with('flash_success', 'Категория успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ImageService $image)
    {
        $model = $this->model->show($id);
        $image->deleteImageDirectory($model, $id);
        $this->model->deleteUrl($id);
        $this->model->delete($id);

        return redirect()->route('admin.category.index')->with('flash_success', 'Категория успешно удалена');
    }
}
