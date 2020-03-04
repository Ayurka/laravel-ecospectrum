<?php


namespace App\Repositories\Backend\User;


use App\Repositories\Backend\CrudRepositoryInterface;
use App\User;

class UserRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
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
        return $this->model->create([
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function update(array $data, $id)
    {
        return $this->show($id)->update([
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
}
