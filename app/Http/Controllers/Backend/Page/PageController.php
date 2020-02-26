<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Requests\Backend\PageRequest;
use App\Repositories\Backend\CrudRepositoryInterface;
use App\Services\ImageService;
use App\Http\Controllers\Controller;

class PageController extends Controller
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
        $pages = $this->model->paginate(15);
        return view('backend.page.page_form.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryTree = $this->model->getCategoryTree();
        return view('backend.page.page_form.create', compact('categoryTree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request, ImageService $image)
    {
        $model = $this->model->create($request->all());

        $this->model->createUrl($model->id);

        $image->setImages($model, $request);

        return redirect()->route('admin.page.index')->with('flash_success', 'Страница успешно создана');
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
        $page = $this->model->show($id);
        $categoryTree = $this->model->getCategoryTree();

        $preview = $image->getConfigImages($page->images);

        return view('backend.page.page_form.edit', compact('page', 'categoryTree', 'preview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param  int  $id
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id, ImageService $image)
    {
        $model = $this->model->update($request->all(), $id);

        $this->model->updateUrl($model->id);

        $image->setImages($model, $request);

        return redirect()->route('admin.page.index')->with('flash_success', 'Страница успешно обновлена');

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

        return redirect()->route('admin.page.index')->with('flash_success', 'Страница успешно удалена');
    }
}
