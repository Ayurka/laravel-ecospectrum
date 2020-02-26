<?php


namespace App\Repositories\Backend\News;

use App\Models\Backend\News;
use App\Repositories\Backend\CrudRepositoryInterface;
use Illuminate\Support\Arr;

class NewsRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new News();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(int $number)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($number);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->show($id);
        $model->update(Arr::add($data, 'public', false));

        return $model;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createUrl($id)
    {
        $model = $this->show($id);
        if ($model->category) {
            $category_slug = $model->category->url->url;
            $slug = $category_slug . '/' . $model->slug;
            return $model->url()->create(['url' => $slug]);
        } else {
            return $model->url()->create(['url' => $model->slug]);
        }
    }

    public function updateUrl($id)
    {
        $model = $this->show($id);
        if ($model->category) {
            $category_slug = $model->category->url->url;
            $slug = $category_slug . '/' . $model->slug;
            return $model->url()->update(['url' => $slug]);
        } else {
            return $model->url()->update(['url' => $model->slug]);
        }
    }

    public function deleteUrl($id)
    {
        $model = $this->show($id);
        $model->url()->delete();
    }
}