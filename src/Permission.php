<?php

namespace Inoplate\UserManagement;

use Illuminate\Support\Collection;

class Permission
{
    /**
     * @var Illuminate\Support\Collection
     */
    protected $items;

    /**
     * Primary key
     * 
     * @var string
     */
    protected $id = 'name';

    /**
     * Create new Permission instance
     */
    public function __construct()
    {
        $this->items = new Collection;
    }

    /**
     * Retrieve all permissions
     * 
     * @return Coll
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Find permission by id
     * 
     * @param  mixed $id
     * @return array
     */
    public function find($id)
    {
        return $this->items->first(function($key, $value) use ($id){
            return $value[$this->id] == $id;
        });
    }

    /**
     * Insert new permision
     * 
     * @param  array $item
     * @return array
     */
    public function insert(array $item)
    {
        if(!$this->find($item[$this->id])) {
            $this->items->push($item);
        }

        return $item;
    }

    /**
     * Update permission by id
     * 
     * @param  mixed  $id
     * @param  array  $item
     * @return array
     */
    public function update($id, array $item)
    {
        if($this->find($id)) {
            $item[$this->id] = $id;

            $this->remove($id);
            $thiso->insert($item);
        }
    }

    /**
     * Remove permission by id
     * 
     * @param mixed $id
     * @return void
     */
    public function remove($id)
    {
        $this->items->reject(function($value, $key) use ($id){
            return $value[$this->id] != $id;
        });
    }
}