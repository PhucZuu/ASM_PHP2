<?php

namespace Phucle\Assignment\Models;

use Phucle\Assignment\Commons\Helper;
use Phucle\Assignment\Commons\Model;

class News extends Model
{
    protected string $tableName = 'tintuc';

    public function allDanhMuc()
    {
        return $this->queryBuilder
            ->select('*')
            ->from('danhmuctintuc')
            ->orderBy('idDanhMuc', 'desc')
            ->fetchAllAssociative();

    }

    public function paginate($page = 1, $perPage = 5)
    {
        $totalPage = ceil($this->count() / $perPage);

        $offset = $perPage * ($page - 1);

        $data = $this->queryBuilder
            ->select('*')
            ->from($this->tableName, 'tt')
            ->innerJoin('tt', 'danhmuctintuc', 'dmtt', 'tt.danhMucId = dmtt.idDanhMuc')
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->where('tt.kichHoat = 1')
            ->andWhere('(tt.trangThaiId = 1 OR tt.trangThaiId = 0)')
            ->orderBy('tt.idTinTuc', 'desc')
            ->fetchAllAssociative();

        return [$data, $totalPage];
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
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('idTinTuc = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }

    public function update($id, array $data)
    {
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
}

