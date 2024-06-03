<?php

namespace Phucle\Assignment\Controllers\Admin;

use Phucle\Assignment\Commons\Controller;

class DashboardController extends Controller 
{
    public function dashboard()
    {
        $this->renderViewAdmin(__FUNCTION__);
    }
}