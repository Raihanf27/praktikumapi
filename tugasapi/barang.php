<?php
require_once "method.php";
$obj_barang = new barang();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_barang->get_barang($id);
        } else {
            $obj_barang->get_barangs();
        }
        break;
    case 'POST':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_barang->update_barang($id);
        } else {
            $obj_barang->insert_barang();
        }
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $obj_barang->delete_barang($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}