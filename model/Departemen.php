<?php

require_once __DIR__.'/BaseModel.php';

class Departemen extends BaseModel {
    public function getAll() {
        $sql = "SELECT d.*, COUNT(p.id) AS jumlah_pegawai
            FROM departemen AS d
            LEFT JOIN pegawai AS p ON d.id = p.id_departemen
            GROUP BY d.id";
        return $this->db->getMultiResult($sql);
    }

    public function get(int $id) {
        $sql = "SELECT * FROM departemen WHERE id=$id LIMIT 1";
        return $this->db->getSingleResult($sql);
    }

    public function create($nama) {
        $sql = "INSERT INTO departemen (nama) VALUES ('$nama')";
        return $this->db->getResult($sql);
    }

    public function update(int $id, $nama) {
        $sql = "UPDATE departemen SET nama='$nama' WHERE id=$id";
        return $this->db->getResult($sql);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM departemen WHERE id=$id";
        return $this->db->getResult($sql);
    }
}