<?php
namespace Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

Abstract class BaseRepository {

    abstract function model();

    public function getAll()
    {
        return $this->model()::orderBy('id', 'desc')->paginate(10);
    }

    public function findByID($id): Model
    {
        return $this->model()::find($id);
    }

    public function findOrFailByID($id): Model
    {
        return $this->model()::findOrFail($id);
    }

    public function create(array $modelData)
    {
        return $this->model()::create($modelData);
    }

    public function updateByID($id, array $modelData)
    {
        $model = $this->findOrFailByID($id);
        return $model->update($modelData);
    }

    public function deletedByID($id)
    {
        $model = $this->findOrFailByID($id);
        return $model->delete();
    }

    function updateByModelCondition($condition, $field, $value) 
    {
        return $this->model()::where($condition)->update([$field => $value]);
    }
}