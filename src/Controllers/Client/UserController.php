<?php

namespace Phucle\Assignment\Controllers\Client;

use Phucle\Assignment\Commons\Controller;
use Phucle\Assignment\Models\User;

class UserController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function edit()
    { 
        $this->renderViewClient('edit');
           
    }

}