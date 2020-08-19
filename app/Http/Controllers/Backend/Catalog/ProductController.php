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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->model->paginate(15);
        return view('backend.catalog.product_form.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categoryTree = $this->model->getCategoryTree();
        $dataSelect = $this->model->getAllCategories()->content();
        $isAttributes = $this->model->isAttributes();
        $attributeGroups = $this->model->getAttributeGroups();
        $attributeGroupsJson = response()->json($attributeGroups)->content();
        $filters = $this->model->getAllFilters()->content();

        return view('backend.catalog.product_form.create', compact(
            'categoryTree',
            'dataSelect',
            'attributeGroups',
            'filters',
            'attributeGroupsJson',
            'isAttributes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @param ImageService $image
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request, ImageService $image)
    {
        $model = $this->model->create($request->all());

        $this->model->createUrl($model->id);

        $model->getPivotCategories()->sync($request->get('categories'));
        //$model->getPivotFilters()->sync($request->get('filters'));
        $this->model->pivotAttributeProduct($request, $model);

        $image->setImages($model, $request);

        return redirect()->route('admin.product.index')->with('flash_success', 'Товар успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @param ImageService $image
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, ImageService $image)
    {
        $product = $this->model->show($id);
        $categoryTree = $this->model->getCategoryTree();

        $dataSelect = $this->model->getDataSelect($product)->content();
        $isAttributes = $this->model->isAttributes();
        $attributeGroups = $this->model->getAttributeGroups();
        $attributeGroupsJson = response()->json($attributeGroups)->content();

        $preview = $image->getConfigImages($product->images);

        return view('backend.catalog.product_form.edit', compact(
            'product',
            'categoryTree',
            'dataSelect',
            'attributeGroups',
            'attributeGroupsJson',
            'preview',
            'isAttributes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param $id
     * @param ImageService $image
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, $id, ImageService $image)
    {
        $model = $this->model->update($request->all(), $id);

        $this->model->updateUrl($id);

        $model->getPivotCategories()->sync($request->get('categories'));
        $this->model->pivotAttributeProduct($request, $model);
        $image->setImages($model, $request);

        if ($request->has('filters')) {
            // Удаляем элементы из массива, равные null
            $resultFilters = array_diff($request->get('filters'), array(null));
            $model->getPivotFilters()->sync($resultFilters);
        }

        return redirect()->route('admin.product.index')->with('flash_success', 'Товар успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param ImageService $image
     *
     * @return \Illuminate\Http\RedirectResponse
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
