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

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    private $employeeService;

    /**
     * EmployeeController constructor.
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return EmployeeResource
     * @throws \Exception
     */
    public function index(Request $request): EmployeeResource
    {
        $data = $request->toCollection();

        $data['status'] = Employee::STATUS_ACTIVE;

        $model = $this->employeeService->index($data);

        return EmployeeResource::makeResource($model);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return EmployeeResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(Request $request): EmployeeResource
    {
        $data = $request->toCollection();

        $data['user_id'] = auth()->id();

        $model = $this->employeeService->store($data);

        return EmployeeResource::makeResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return EmployeeResource
     */
    public function show(int $id): EmployeeResource
    {
        $model = $this->employeeService->show($id);

        return EmployeeResource::makeResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return EmployeeResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Request $request, int $id): EmployeeResource
    {
        $data = $request->toCollection();

        $data->pull('user_id');

        $model = $this->employeeService->update($data, $id);

        return EmployeeResource::makeResource($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return EmployeeResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy(int $id): EmployeeResource
    {
        $model = $this->employeeService->delete($id);

        return EmployeeResource::makeResource($model);
    }
}
