<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($newRegister)
    {
        return $this->getNamespace()::create($newRegister);
    }

    public function findAll()
    {
        return $this->getNamespace()::all();
    }

    public function findById($id)
    {
        return $this->getNamespace()::where("id", $id)->first();
    }

    public function remove($id)
    {
        $this->getNamespace()::destroy($id);
    }

    public function update($id, $datasModified)
    {
        $this->getNamespace()::where("id", $id)->update($datasModified);
    }

    private function getNamespace() {
        return get_class($this->model);
    }

}