<?php

namespace Inoplate\UserManagement\Permission;

use Inoplate\UserManagement\Permission as Model;
use Inoplate\UserManagement\Contracts\Permission\Repository as Contract;

class InMemoryRepository implements Contract
{
    /**
     * @var Inoplate\UserManagement\Contracts\Permission\Repository
     */
    protected $model;

    /**
     * Create new InMemoryRepository instance
     * 
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all permission
     * 
     * @return array
     */
    public function all()
    {
        return $this->model->all()->toArray();
    }

    /**
     * Retrieve item by id
     * 
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->model->find($id);
    }

    /**
     * Register new permission
     * @param  array  $item
     * @return mixed
     */
    public function register(array $item)
    {
        return $this->model->insert($item);
    }
}