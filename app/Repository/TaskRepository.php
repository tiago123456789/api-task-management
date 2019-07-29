<?php

namespace App\Repository;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Task());
    }

    public function searchAll($idUser)
    {
        return $this->model->where("user_id", $idUser)->get();
    }

    public function removeItem($idUser, $id)
    {
        $this->model->where("user_id", $idUser)->where("id", $id)->delete();
    }

    public function updateItem($idUser, $id, $datasModified)
    {
        $this->model->where("user_id", $idUser)->where("id", $id)->update($datasModified);
    }

    public function searchById($idUser, $id)
    {
        return $this->model->where("user_id", $idUser)->where("id", $id)->first();
    }

    public function findByTitle($title) {
        $title = "%$title%";
        return $this->model->where(DB::raw("upper(title)"), "ILIKE", $title)->first();
    }

    public function complete($idUser) {
        return $this->model->where("user_id", $idUser)->where("done", true)->get();
    }

    public function uncomplete($idUser) {
        return $this->model->where("user_id", $idUser)->where("done", false)->get();
    }
}