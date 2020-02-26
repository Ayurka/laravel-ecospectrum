<?php


namespace App\Repositories\Backend;


interface CrudRepositoryInterface
{
    public function all();

    /*
     * @param array
     */
    public function create(array $data);

    /*
     * @param array
     * @param int
     */
    public function update(array $data, $id);

    /*
     * @param int
     */
    public function delete($id);

    /*
     * @param int
     */
    public function show($id);
}