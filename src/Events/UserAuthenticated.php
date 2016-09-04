<?php

namespace Inoplate\Auth\Events;

class UserAuthenticated
{   
    /**
     * Authenticable user
     * 
     * @var mixed
     */
    public $user;

    /**
     * Create new event instance
     * 
     * @param Authenticable $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}