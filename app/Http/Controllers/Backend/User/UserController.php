<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Repositories\Backend\CrudRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $model;

    public function __construct(CrudRepositoryInterface $crud)
    {
        $this->model = $crud;
    }

    /**
     * Get users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->model->paginate(15);
        return view('backend.user.index', compact('users'));
    }

    /**
     * Create user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Save user
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $model = $this->model->create($request->all());
            $model->company()->create($request->get('company'));
        });

        return redirect()->route('admin.user.index')->with('flash_success', 'Пользователь успешно создан');
    }

    /**
     * Show user
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->model->show($id);
        return view('backend.user.show', compact('user'));
    }

    /**
     * Edit user
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->model->show($id);
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update user
     *
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $this->model->update($request->all(), $id);
            $this->model->show($id)->company()->update($request->get('company'));
        });
        return redirect()->route('admin.user.index')->with('flash_success', 'Пользователь успешно отредактирован');
    }

    /**
     * Delete user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->route('admin.user.index')->with('flash_success', 'Пользователь успешно удален');
    }
}
