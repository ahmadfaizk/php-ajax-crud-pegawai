<?php

require_once __DIR__.'/model/Pegawai.php';
require_once 'response-helper.php';
$pegawai = new Pegawai();

switch ($_REQUEST['action']) {
    case 'all':
        $data = $pegawai->getAll();
        sendResponse(true, 'Success get all pegawai', $data);
        break;
    case 'get':
        checkParameter(['id']);
        $id = $_GET['id'];
        $data = $pegawai->get($id);
        if ($data != null) {
            sendResponse(true, 'Success get pegawai', $data);
        } else {
            sendResponse(false, 'Pegawai not found', null);
        }
        break;
    case 'new':
        checkParameter(['id_departemen', 'nama', 'gender', 'alamat']);
        $idDepartemen = $_REQUEST['id_departemen'];
        $nama = $_REQUEST['nama'];
        $gender = $_REQUEST['gender'];
        $alamat = $_REQUEST['alamat'];
        if ($pegawai->create($idDepartemen, $nama, $gender, $alamat)) {
            sendResponse(true, 'Success create pegawai', null);
        } else {
            sendResponse(false, 'Error create pegawai', null);
        }
        break;
    case 'update':
        checkParameter(['id', 'id_departemen', 'nama', 'gender', 'alamat']);
        $id = $_REQUEST['id'];
        $idDepartemen = $_REQUEST['id_departemen'];
        $nama = $_REQUEST['nama'];
        $gender = $_REQUEST['gender'];
        $alamat = $_REQUEST['alamat'];
        if ($pegawai->update($id, $idDepartemen, $nama, $gender, $alamat)) {
            sendResponse(true, 'Success update pegawai', null);
        } else {
            sendResponse(false, 'Error update pegawai', null);
        }
        break;
    case 'delete':
        checkParameter(['id']);
        $id = $_REQUEST['id'];
        if ($pegawai->delete($id)) {
            sendResponse(true, 'Success delete pegawai', null);
        } else {
            sendResponse(false, 'Error delete pegawai', null);
        }
        break;
    default:
        sendResponse(false, 'Error', null);
        break;
}