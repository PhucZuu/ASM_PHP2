<?php

namespace Phucle\Assignment\Controllers\Admin;

use Phucle\Assignment\Commons\Controller;
use Phucle\Assignment\Commons\Helper;
use Phucle\Assignment\Models\News;
use Rakit\Validation\Validator;

class NewsController extends Controller
{
    private News $news;

    public function __construct()
    {
        $this->news = new News();
    }

    public function index()
    {
        echo __CLASS__ . "@" . __FUNCTION__;
    }

    public function create()
    {
        echo __CLASS__ ."@". __FUNCTION__;
    }

    public function store()
    {
        echo __CLASS__ . "@" . __FUNCTION__;

    }
    public function show($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . ' - ID = ' . $id;
    }

    public function edit($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . ' - ID = ' . $id;
    }

    public function update($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . ' - ID = ' . $id;
    }

    public function delete($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . ' - ID = ' . $id;
        
    }
}
