<?php

require_once __DIR__.'/model/Departemen.php';
require_once 'response-helper.php';
$departemen = new Departemen();

switch ($_REQUEST['action']) {
    case 'all':
        $data = $departemen->getAll();
        sendResponse(true, 'Success get all departemen', $data);
        break;
    case 'get':
        checkParameter(['id']);
        $id = $_GET['id'];
        $data = $departemen->get($id);
        if ($data != null) {
            sendResponse(true, 'Success get departemen', $data);
        } else {
            sendResponse(false, 'Departemen not found', null);
        }
        break;
    case 'new':
        checkParameter(['nama']);
        $nama = $_REQUEST['nama'];
        if ($departemen->create($nama)) {
            sendResponse(true, 'Success create departemen', $data);
        } else {
            sendResponse(false, 'Error create departemen', $data);
        }
        break;
    case 'update':
        checkParameter(['id', 'nama']);
        $id = $_REQUEST['id'];
        $nama = $_REQUEST['nama'];
        if ($departemen->update($id, $nama)) {
            sendResponse(true, 'Success update departemen', $data);
        } else {
            sendResponse(false, 'Error update departemen', $data);
        }
        break;
    case 'delete':
        checkParameter(['id']);
        $id = $_REQUEST['id'];
        if ($departemen->delete($id)) {
            sendResponse(true, 'Success delete departemen', $data);
        } else {
            sendResponse(false, 'Error delete departemen', $data);
        }
        break;
    default:
        sendResponse(false, 'Error', null);
        break;
}