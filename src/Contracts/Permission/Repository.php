<?php

namespace Inoplate\UserManagement\Contracts\Permission;

interface Repository
{
    /**
     * Retrieve all permission
     * 
     * @return Collection
     */
    public function all();

    /**
     * Retrieve item by id
     * 
     * @param  mixed $id
     * @return array
     */
    public function get($id);

    /**
     * Register new permission
     * @param  array  $item
     * @return array
     */
    public function register(array $item);
}