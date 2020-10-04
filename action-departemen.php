<?php

require_once __DIR__.'/model/Departemen.php';
$departemen = new Departemen();

switch ($_REQUEST['action']) {
    case 'new':
        $nama = $_REQUEST['nama'];
        if ($departemen->create($nama)) {
            header('Location: list-departemen.php');
        } else {
            die("Error Create Data");
        }
        break;
    case 'update':
        $id = $_REQUEST['id'];
        $nama = $_REQUEST['nama'];
        if ($departemen->update($id, $nama)) {
            header('Location: list-departemen.php');
        } else {
            die("Error Update Data");
        }
        break;
    case 'delete':
        $id = $_REQUEST['id'];
        if ($departemen->delete($id)) {
            header('Location: list-departemen.php');
        } else {
            die("Error Delete Data");
        }
        break;
    default:
        die('Action Error');
        break;
}