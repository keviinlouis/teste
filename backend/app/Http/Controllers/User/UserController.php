<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:47
 */

namespace App\Http\Controllers\User;

use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return UserResource
     * @throws \Exception
     */
    public function index(Request $request): UserResource
    {

        $model = $this->userService->index($request->toCollection());

        return UserResource::makeResource($model);

    }


    /** Login Method
     * @param Request $request
     * @return UserResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function login(Request $request): UserResource
    {
        $model = $this->userService->login($request->toCollection());

        return UserResource::makeResource($model)->withToken();
    }

    /**
     * Display the specified resource.
     *
     * @return UserResource
     */
    public function me(): UserResource
    {
        $model = $this->userService->show(auth()->id());

        return UserResource::makeResource($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(Request $request): UserResource
    {
        $model = $this->userService->store($request->toCollection());

        return UserResource::makeResource($model)->withToken();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $model = $this->userService->show($id);

        return UserResource::makeResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return UserResource
     * @throws \Exception
     */
    public function update(Request $request): UserResource
    {
        $model = $this->userService->update($request->toCollection(), auth()->id());

        return UserResource::makeResource($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return UserResource
     * @throws \Exception
     */
    public function destroy(): UserResource
    {
        $model = $this->userService->delete(auth()->id());

        return UserResource::makeResource($model);
    }

    public function orderActive()
    {
        $order = auth()->user()->orderActive;

        if($order){
            return OrderResource::makeResource($order);
        }

        return response()->json([
           'success' => true,
           'data' => null
        ]);
    }

}
