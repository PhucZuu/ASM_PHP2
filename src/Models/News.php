<?php

namespace Phucle\Assignment\Models;

use Phucle\Assignment\Commons\Helper;
use Phucle\Assignment\Commons\Model;

class News extends Model
{
    protected string $tableName = 'tintuc';
    public function all($limit = null)
    {
        $query = $this->queryBuilder
            ->select('tt.*, dm.tenDanhMuc', 'tk.tenDangNhap')
            ->from($this->tableName, 'tt')
            ->innerJoin('tt', 'danhmuctintuc', 'dm', 'tt.danhMucId = dm.idDanhMuc')
            ->orderBy('tt.idTinTuc', 'desc');

        if ($limit !== null) {
            $query->setMaxResults($limit);
        }

        return $query->executeQuery()->fetchAllAssociative();
    }


    public function allDanhMuc()
    {
        return $this->queryBuilder
            ->select('*')
            ->from('danhmuctintuc')
            ->fetchAllAssociative();

    }

    public function paginate($page = 1, $perPage = 4)
    {
        $totalPage = ceil($this->count() / $perPage);

        $offset = $perPage * ($page - 1);

        $data = $this->queryBuilder
            ->select('DISTINCT tt.*, dmtt.tenDanhMuc', 'tk.tenDangNhap')
            ->from($this->tableName, 'tt')
            ->innerJoin('tt', 'danhmuctintuc', 'dmtt', 'tt.danhMucId = dmtt.idDanhMuc')
            ->innerJoin('tt', 'taikhoan', 'tk', 'tt.nguoiDungId = tk.idNguoiDung')
            ->where('tt.kichHoat = 1')
            ->orderBy('tt.idTinTuc', 'desc')
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->fetchAllAssociative();

        return [
            'data' => $data,
            'totalPage' => $totalPage,
            'currentPage' => $page,
            'totalRecords' => $this->count(),
        ];
    }


    public function insert(array $data)
    {
        $danhMucList = $this->allDanhMuc();
        if (!empty($data)) {
            $query = $this->queryBuilder->insert($this->tableName);
            $index = 0;
            foreach ($data as $key => $value) {
                $query->setValue($key, '?')->setParameter($index, $value);

                ++$index;
            }

            $query->executeQuery();
            // echo $query->getSQL();
            // die;
            return true;
        }

        return false;
    }

    public function findByidTinTuc($id)
    {
        $data = $this->queryBuilder
            ->select('tt.*, dmtt.tenDanhMuc', 'tk.tenDangNhap')
            ->from($this->tableName, 'tt')
            ->innerJoin('tt', 'danhmuctintuc', 'dmtt', 'tt.danhMucId = dmtt.idDanhMuc')
            ->innerJoin('tt', 'taikhoan', 'tk', 'tt.nguoiDungId = tk.idNguoiDung')
            ->where('tt.idTinTuc = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();



        return $data;
    }

    public function update($id, array $data)
    {
        $danhMucList = $this->allDanhMuc();
        if (!empty($data)) {
            $query = $this->queryBuilder->update($this->tableName);

            $index = 0;

            foreach ($data as $key => $value) {

                $query->set($key, '?')->setParameter($index, $value);

                ++$index;
            }

            $query->where('idTinTuc = ?')
                ->setParameter($index, $id)
                ->executeQuery();
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('idTinTuc = ?')
            ->setParameter(0, $id)
            ->executeQuery();
    }

    public function restore()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName, 'tt')
            ->innerJoin('tt', 'danhmuctintuc', 'dmtt', 'tt.danhMucId = dmtt.idDanhMuc')
            ->where('tt.kichHoat = ?')->setParameter(0, 0)
            ->orderBy('idTinTuc', 'desc')
            ->fetchAllAssociative();
    }

    public function searchNews($word = "", $id = 0)
    {
        $query = $this->queryBuilder;

        if (!empty($word)) {
            $query->where('tt.tieuDe LIKE :word')
                ->setParameter('word', '%' . $word . '%');
        }

        if ($id > 0) {
            $query->andWhere('tt.idTinTuc = :id')
                ->setParameter('id', $id);
        }

        return $query->fetchAllAssociative();
    }

}

