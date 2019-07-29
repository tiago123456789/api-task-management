<?php

namespace App\Service;

use App\Exceptions\LogicNegociationException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use App\Helpers\HttpStatus;
use App\Repository\TaskRepository;

class TaskService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new TaskRepository();
    }

    public function findAll($idUser)
    {
        return $this->repository->searchAll($idUser);
    }

    public function findById($idUser, $id)
    {
        $task = $this->repository->searchById($idUser, $id);
        if (!$task) {
            throw new NotFoundException(MessageException::NOT_FOUND_REGISTER, ["Task"]);
        }
        return $task;
    }

    public function remove($idUser, $id) {
        $this->findById($idUser, $id);
        $this->repository->removeItem($idUser, $id);
    }

    public function update($idUser, $id, $dataModified) {
        $this->findById($idUser, $id);
        $this->repository->updateItem($idUser, $id, $dataModified);
    }

    public function uncomplete($idUser)
    {
        return $this->repository->uncomplete($idUser);
    }

    public function complete($idUser)
    {
        return $this->repository->complete($idUser);
    }

    public function create($newRegister)
    {
        $taskWithTitleAlready = $this->repository->findByTitle($newRegister["title"]);
        if ($taskWithTitleAlready) {
            throw new LogicNegociationException(MessageException::TITLE_TASK_ALREADY);
        }

        return $this->repository->create($newRegister);
    }

}