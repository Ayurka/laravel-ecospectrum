<?php

namespace App\Repositories\Backend\Order;

use App\Models\Backend\Order;
use App\Repositories\Backend\CrudRepositoryInterface;

class OrderRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Order();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(int $number)
    {
        return $this->model->with('user')->orderBy('created_at', 'desc')->paginate($number);
    }

    /*
     * @param array
     */
    public function create(array $data)
    {

    }

    /*
     * @param array
     * @param int
     */
    public function update(array $data, $id)
    {

    }

    /*
     * @param int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /*
     * @param int
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
}
