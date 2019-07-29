<?php

namespace App\Http\Controllers;

use App\Config\App;
use App\Helpers\Token;
use App\Http\Requests\TaskRequest;
use App\Service\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $service;

    function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function uncomplete()
    {
        return response()->json($this->service->uncomplete($this->getIdUserToken()));
    }

    public function complete()
    {
        return response()->json($this->service->complete($this->getIdUserToken()));
    }

    public function findAll()
    {
        return response()->json($this->service->findAll($this->getIdUserToken()));
    }

    public function findById($id)
    {
        return response()->json($this->service->findById($this->getIdUserToken(), $id));
    }

    public function remove($id)
    {
        $this->service->remove($this->getIdUserToken(), $id);
        return response()->json("", 204);
    }

    public function update($id, Request $request)
    {
        $datasModified = $request->all();
        $this->service->update($this->getIdUserToken(), $id, $datasModified);
        return response()->json("", 204);
    }

    public function create(TaskRequest $request)
    {
        $request->validated();
        $newRegister = $request->all();
        $newRegister["user_id"] = $this->getIdUserToken();
        $this->service->create($newRegister);
        return response()->json("", 201);
    }

    private function getIdUserToken() {
        $accessToken = request()->header(App::PARAM_AUTH);
        return Token::getValueInPayload("id", $accessToken);
    }
}
