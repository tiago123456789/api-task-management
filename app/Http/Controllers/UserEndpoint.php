<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;

class UserEndpoint extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(Request $request) {
        $this->validate($request, [
            "name" => "required|max:65",
            "email" => "required|max:70",
            "password" => "required",
        ]);

        $newRegister = $request->all();
        $this->service->create($newRegister);
        return response()->json("", 201);
    }
}
