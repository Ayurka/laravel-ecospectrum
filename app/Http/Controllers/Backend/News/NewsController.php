<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Requests\Backend\NewsRequest;
use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Repositories\Backend\CrudRepositoryInterface;

class NewsController extends Controller
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
        $news = $this->model->paginate(15);
        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request, ImageService $image)
    {
        $model = $this->model->create($request->all());

        $this->model->createUrl($model->id);

        $image->setImage($model, $request);

        return redirect()->route('admin.news.index')->with('flash_success', 'Новость успешно создана');
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
        $new = $this->model->show($id);

        $img = $new->image;
        $initialPreviewFirst = $image->getInitialPreviewFirst($img);
        $initialPreviewConfigFirst = $image->getInitialPreviewConfigFirst($img);

        return view('backend.news.edit', compact('new','initialPreviewFirst', 'initialPreviewConfigFirst'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param  int  $id
     * @param ImageService $image
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id, ImageService $image)
    {
        $model = $this->model->update($request->all(), $id);

        $this->model->updateUrl($model->id);

        $image->setImage($model, $request);

        return redirect()->route('admin.news.index')->with('flash_success', 'Новость успешно обновлена');

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

        return redirect()->route('admin.news.index')->with('flash_success', 'Новость успешно удалена');
    }
}
