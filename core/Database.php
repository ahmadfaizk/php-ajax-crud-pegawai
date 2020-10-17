<?php

class Database {
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbName = 'perusahaan';
    private $db;

    public function __construct() {
        //Membuat Koneksi
        $this->db = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        //Mengecek Koneksi
        if ($this->db->connect_error) {
            die("Koneksi Gagal : " . $this->db->connect_error);
        }
    }

    public function getResult(String $sql) {
        $result = $this->db->query($sql);
        return $result;
    }

    public function getError() {
        return $this->db->error;
    }

    public function getSingleResult(String $sql) {
        return $this->getResult($sql)->fetch_assoc();
    }

    public function getMultiResult(String $sql) {
        $result = $this->getResult($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return $data;
    }
}