<?php

namespace Phucle\Assignment\Models;

use Phucle\Assignment\Commons\Model;

class User extends Model
{
    protected string $tableName = 'taikhoan';

    public function restore()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('kichHoat = ?')
            ->setParameter(0, 0)
            ->orderBy('idNguoiDung	', 'desc')
            ->fetchAllAssociative();
    }
}