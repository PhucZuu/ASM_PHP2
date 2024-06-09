<?php

namespace Phucle\Assignment\Controllers\Client;

use Phucle\Assignment\Commons\Controller;
use Phucle\Assignment\Commons\Helper;
use Phucle\Assignment\Models\News;
use Phucle\Assignment\Models\User;

class HomeController extends Controller
{
    private News $news;
    private User $user;

    public function __construct()
    {
        $this->news = new News();
    }

    public function home()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 3; // Or any desired number of products per page

        $lists = $this->news->allDanhMuc();

        $result = $this->news->paginate($_GET['page'] ?? 1);

        $this->renderViewClient('home', [
            'news' => $result['data'],
            'lists' => $lists,
            'totalPage' => $result['totalPage'],
            'currentPage' => $result['currentPage'],
            'totalRecords' => $result['totalRecords']

        ]);
    }

    public function newDetail($id)
    {
        $lists = $this->news->allDanhMuc();



        $new = $this->news->findByidTinTuc($id);

        $this->renderViewClient('newDetail', [

            'new' => $new,
            'lists' => $lists,

        ]);
    }

    public function searchNews()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 3; // Or any desired number of products per page
        $result = $this->news->paginate($_GET['page'] ?? 1, 9);

        $word = isset($_POST['word']) ? $_POST['word'] : "";
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

        $lists = $this->news->allDanhMuc();

        $newSearch = $this->news->searchNews($word, $id);

        $this->renderViewClient('search', [
            'lists' => $lists,
            'news' => $result['data'],
            'word' => $word,
            'newSearch' => $newSearch,
            'totalPage' => $result['totalPage'],
            'currentPage' => $result['currentPage'],
            'totalRecords' => $result['totalRecords']
        ]);
    }

}

