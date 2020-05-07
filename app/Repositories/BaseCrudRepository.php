<?php


namespace App\Repositories;

use App\Repositories\Interfaces\CrudRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseCrudRepository implements CrudRepositoryInterface
{
    protected Model $model;

    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    function findAll()
    {
        return $this->model->select();
    }

    function findOne(int $id)
    {
        return $this->model->find($id);
    }

    function create(array $attribute)
    {
        return $this->model->create($attribute);
    }

    function update(int $id, array $attribute)
    {
        $attribute['id'] = $id;
        $existed = $this->model->find($id);
        if ($existed) {
            $existed->update($attribute);
            return $this->model->find($id);
        }
        return null;
    }

    function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
