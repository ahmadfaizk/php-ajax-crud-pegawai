<?php

require_once __DIR__.'/model/Pegawai.php';
$pegawai = new Pegawai();

switch ($_REQUEST['action']) {
    case 'new':
        $idDepartemen = $_REQUEST['departemen'];
        $nama = $_REQUEST['nama'];
        $gender = $_REQUEST['gender'];
        $alamat = $_REQUEST['alamat'];
        if ($pegawai->create($idDepartemen, $nama, $gender, $alamat)) {
            header('Location: list-pegawai.php');
        } else {
            print_r($_REQUEST);
            die("Error Create Data");
        }
        break;
    case 'update':
        $id = $_REQUEST['id'];
        $idDepartemen = $_REQUEST['departemen'];
        $nama = $_REQUEST['nama'];
        $gender = $_REQUEST['gender'];
        $alamat = $_REQUEST['alamat'];
        if ($pegawai->update($id, $idDepartemen, $nama, $gender, $alamat)) {
            header('Location: list-pegawai.php');
        } else {
            die("Error Update Data");
        }
        break;
    case 'delete':
        $id = $_REQUEST['id'];
        if ($pegawai->delete($id)) {
            header('Location: list-pegawai.php');
        } else {
            die("Error Delete Data");
        }
        break;
    default:
        die('Action Error');
        break;
}