<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Requests\Backend\ProductRequest;
use App\Repositories\Backend\CrudRepositoryInterface;
use App\Services\ImageService;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
        $products = $this->model->paginate(15);
        return view('backend.catalog.product_form.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryTree = $this->model->getCategoryTree();
        $dataSelect = $this->model->getAllCategories()->content();
        $attributeGroups = $this->model->getAttributeGroups();
        $filters = $this->model->getAllFilters()->content();

        return view('backend.catalog.product_form.create', compact('categoryTree', 'dataSelect', 'attributeGroups', 'filters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ImageService $image)
    {
        $model = $this->model->create($request->all());

        $this->model->createUrl($model->id);

        $model->getPivotCategories()->sync($request->get('categories'));
        $model->getPivotFilters()->sync($request->get('filters'));
        $this->model->pivotAttributeProduct($request, $model);

        $image->setImages($model, $request);

        return redirect()->route('admin.product.index')->with('flash_success', 'Товар успешно создан');
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
        $product = $this->model->show($id);
        $categoryTree = $this->model->getCategoryTree();

        $dataSelect = $this->model->getDataSelect($product)->content();
        $filters = $this->model->getDataFilters($product)->content();
        $attributeGroups = $this->model->getAttributeGroups();
        $attributeGroupsJson = $attributeGroups;

        $preview = $image->getConfigImages($product->images);

        return view('backend.catalog.product_form.edit', compact(
            'product',
            'categoryTree',
            'dataSelect',
            'filters',
            'attributeGroups',
            'attributeGroupsJson',
            'preview'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param  int  $id
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id, ImageService $image)
    {
        $model = $this->model->update($request->all(), $id);

        $this->model->updateUrl($id);

        $model->getPivotCategories()->sync($request->get('categories'));
        $model->getPivotFilters()->sync($request->get('filters'));
        $this->model->pivotAttributeProduct($request, $model);

        $image->setImage($model, $request);
        $image->setImages($model, $request);

        return redirect()->route('admin.product.index')->with('flash_success', 'Товар успешно обновлен');
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

        return redirect()->route('admin.product.index')->with('flash_success', 'Товар успешно удален');
    }
}
