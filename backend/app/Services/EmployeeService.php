<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:48
 */

namespace App\Services;

use App\Exceptions\EmployeeForbiddenException;
use App\Http\Controllers\User\EmployeeController;
use App\Models\Employee;
use App\Models\User;
use App\Validators\EmployeeRules;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Class EmployeeService
 * @package App\Services
 */
class EmployeeService extends BaseService
{
    public $relations;

    public $relationsCount;

    /**
     * EmployeeService constructor.
     */
    public function __construct()
    {
        $this->relations = [];
        $this->relationsCount = [];
    }


    /**
     * Listagem de Employee
     * @param Collection $filters
     * @return Employee[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws Exception
     */
    public function index(Collection $filters = null)
    {
        if(!$filters) {
            $filters = collect();
        }

        $query = Employee::with($this->relations);

        if($status = $filters->get('status')) {
            $query->whereIn('status', (array)$status);
        }

        if($search = $filters->get('search')){
            $query->where('name', 'like', "%$search%");
        }

        $order = $filters->get('desc', false) ? 'desc' : $filters->get('order', 'asc');

        $sortBy = $filters->get('sort', 'id');

        $limit = $filters->get('limit', 15);

        $query->orderBy($sortBy, $order);

        return $limit > 0 ? $query->paginate($limit) : $query->get();
    }

    /**
     * Visualizar Employee pelo id
     * @param int|Employee $model
     * @return Employee
     * @throws ModelNotFoundException
     */
    public function show($model): Employee
    {
        if(!$model instanceof Employee) {
            $model = Employee::whereId($model)->firstOrFail();
        }

        return $model->load($this->relations);
    }

    /**
     * Criar Employee
     * @param Collection $data
     * @return Employee
     * @throws Exception
     */
    public function store(Collection $data): Employee
    {
        $this->validateWithArray($data->toArray(), EmployeeRules::store());

        \DB::beginTransaction();

        $model = Employee::create($data->all());

        \DB::commit();

        return $this->show($model);
    }


    /**
     * Atualizar Employee
     * @param Collection $data
     * @param int|Employee $id
     * @throws ModelNotFoundException
     * @throws Exception
     * @throws \Throwable
     * @return Employee
     */
    public function update(Collection $data, $id): Employee
    {
        $this->validateWithArray($data->toArray(), EmployeeRules::update());

        $model = $this->show($id);

        $this->checkOwner($model);

        \DB::beginTransaction();

        $model->update($data->all());

        \DB::commit();

        return $this->show($model);
    }

    /**
     * Deletar Employee
     * @param int|Employee $id
     * @return Employee
     * @throws ModelNotFoundException
     * @throws Exception
     * @throws \Throwable
     */
    public function delete($id): Employee
    {
        $model = $this->show($id);

        $this->checkOwner($model);

        \DB::beginTransaction();

        $model->update(['status' => Employee::STATUS_INACTIVE]);

        \DB::commit();

        return $model;
    }

    /**
     * @param Employee $employee
     * @throws \Throwable
     */
    private function checkOwner(Employee $employee)
    {
        if(!auth()->user() instanceof User){
            return;
        }

        throw_if(
            $employee->user_id != auth()->id(),
            EmployeeForbiddenException::class
        );
    }
}
