<?php

require_once __DIR__.'/BaseModel.php';

class Pegawai extends BaseModel {
    public function getAll() {
        $sql = "SELECT p.*, d.nama AS nama_departemen 
            FROM pegawai AS p
            JOIN departemen AS d ON p.id_departemen = d.id
            ORDER BY p.id";
        return $this->db->getMultiResult($sql);
    }

    public function get(int $id) {
        $sql = "SELECT * FROM pegawai WHERE id=$id LIMIT 1";
        return $this->db->getSingleResult($sql);
    }

    public function create($idDepartemen, $nama, $tempatLahir, $tglLahir, $jenisKelamin, $alamat) {
        $sql = "INSERT INTO pegawai (id_departemen, nama, tempat_lahir, tgl_lahir, jenis_kelamin, alamat)
            VALUES ('$idDepartemen', '$nama', '$tempatLahir', '$tglLahir', '$jenisKelamin', '$alamat')";
        return $this->db->getResult($sql);
    }

    public function update(int $id, $idDepartemen, $nama, $tempatLahir, $tglLahir, $jenisKelamin, $alamat) {
        $sql = "UPDATE pegawai
            SET id_departemen='$idDepartemen', nama='$nama', tempat_lahir='$tempatLahir', 
                tgl_lahir='$tglLahir', jenis_kelamin='$jenisKelamin', alamat='$alamat'
            WHERE id=$id";
        return $this->db->getResult($sql);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM pegawai WHERE id=$id";
        return $this->db->getResult($sql);
    }
}