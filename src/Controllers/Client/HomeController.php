<?php 

namespace Phucle\Assignment\Controllers\Client;

use Phucle\Assignment\Commons\Controller;

class HomeController extends Controller
{
    public function index() {
        $name = 'DucTV44';

        $this->renderViewClient('home', [
            'name' => $name
        ]);
    }
}