<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:51
 */

namespace App\Services;

use App\Exceptions\WrongPasswordException;
use App\Models\User;
use App\Validators\UserRules;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService
{
    public $relations;

    public $relationsCount;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->relations = [];
        $this->relationsCount = [];
    }


    /**
     * Listagem de User
     * @param Collection $filters
     * @return User[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws Exception
     */
    public function index(Collection $filters = null)
    {
        if(!$filters) {
            $filters = collect();
        }

        $query = User::with($this->relations);

        $order = $filters->get('desc', false) ? 'desc' : 'asc';

        $sortBy = $filters->get('sort', 'id');

        $limit = $filters->get('limit', 15);

        $query->orderBy($sortBy, $order);

        return $limit > 0 ? $query->paginate($limit) : $query->get();
    }

    /**
     * Visualizar User pelo id
     * @param int|User $model
     * @return User
     * @throws ModelNotFoundException
     */
    public function show($model): User
    {
        if(!$model instanceof User) {
            $model = User::whereId($model)->firstOrFail();
        }

        return $model->load($this->relations);
    }

    /**
     * Criar User
     * @param Collection $data
     * @return User
     * @throws Exception
     */
    public function store(Collection $data): User
    {
        $this->validateWithArray($data->toArray(), UserRules::store());

        $model = User::create($data->all());

        return $this->show($model);
    }


    /**
     * Atualizar User
     * @param Collection $data
     * @param int|User $id
     * @throws ModelNotFoundException
     * @throws Exception
     * @return User
     */
    public function update(Collection $data, $id): User
    {
        $model = $this->show($id);

        if($data->get('email') == $model->email){
            $data->pull('email');
        }

        $this->validateWithArray($data->toArray(), UserRules::update());

        $model->update($data->all());

        return $this->show($model);
    }

    /**
     * Deletar User
     * @param int|User $id
     * @return User
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function delete($id): User
    {
        $model = $this->show($id);

        $model->delete();

        return $model;
    }

    /**
     * @param Collection $data
     * @return User
     * @throws Exception
     * @throws \Throwable
     */
    public function login(Collection $data): User
    {
        $this->validateWithArray($data, UserRules::login());
        $model = User::whereEmail($data->get('email'))->first();

        throw_if(
            !$model->checkPassword($data->get('password')),
            WrongPasswordException::class
        );

        return $model;
    }
}
