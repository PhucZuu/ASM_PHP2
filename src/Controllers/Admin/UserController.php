<?php

namespace Phucle\Assignment\Controllers\Admin;

use Phucle\Assignment\Commons\Controller;
use Phucle\Assignment\Commons\Helper;
use Phucle\Assignment\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        [$users, $totalPage] = $this->user->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('users.index', [
            'users' => $users,
            'totalPage' => $totalPage
        ]);
    }

    public function create()
    {
        $this->renderViewAdmin('users.create');
    }

    public function store()
    {
        echo __CLASS__ . "@" . __FUNCTION__;

    }
    public function show($idNguoiDung)
    {
        $user = $this->user->findByidNguoiDung($idNguoiDung);

        $this->renderViewAdmin('users.show', [
            'user' => $user
        ]);
    }

    public function edit($idNguoiDung)
    {
        $user = $this->user->findByidNguoiDung($idNguoiDung);

        $this->renderViewAdmin('users.edit', [
            'user' => $user
        ]);
    }

    public function update($idNguoiDung)
    {
        $user = $this->user->findByidNguoiDung($idNguoiDung);
       
        $data = [
            
            'vaiTro' => $_POST['vaiTro'],
            'kichHoat' => $_POST['kichHoat']
        ];
 
        $this->user->update($idNguoiDung, $data);

        // Đặt thông báo phiên
        $_SESSION['status'] = true;
        $_SESSION['msg'] = 'Thao tác thành công';

        // Chuyển hướng sau khi cập nhật
        header('Location: ' . url("admin/users/{$idNguoiDung}/edit"));
        exit;
    }


    public function delete($idNguoiDung)
    {
        try {

            $user = $this->user->findByidNguoiDung($idNguoiDung);

            $this->user->delete($idNguoiDung);


            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

        } catch (\Throwable $th) {

            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
        }

        header('Location: ' . url('admin/users'));
        exit();

    }
}
