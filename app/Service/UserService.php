<?php

namespace App\Service;

use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use App\Repository\UserRepository;
use App\Helpers\HttpStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;

class UserService
{

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($newRegister) {
        $userWithEmailAlready = $this->repository->findByEmail($newRegister["email"]);
        if ($userWithEmailAlready) {
            throw new NotFoundException(MessageException::EMAIL_USED, null, HttpStatus::CONFLICT);
        }

        $newRegister["password"] = Hash::make($newRegister["password"]);
        return $this->repository->create($newRegister);
    }
}