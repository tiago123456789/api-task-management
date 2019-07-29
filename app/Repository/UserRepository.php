<?php

namespace App\Repository;


use App\Models\User;

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function findByEmail($email) {
        return $this->model->where("email", $email)->first();
    }
}