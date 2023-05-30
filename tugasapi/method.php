<?php
require_once "koneksi.php";
class barang
{
    public function get_barangs()
    {
        global $koneksi;
        $query = "SELECT * FROM barangs";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'list barang berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_barang($id = 0)
    {
        global $koneksi;
        $query = "SELECT * FROM barangs";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get Barang berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function insert_barang()
    {
        global $koneksi;
        $arrcheckpost = array(
            'name' => '',
            'harga' => '',
            'qty' => '',
            'satuan' => '',
            'berat' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "INSERT INTO barangs SET
name = '$_POST[name]',
harga = '$_POST[harga]',
qty = '$_POST[qty]',
satuan = '$_POST[satuan]',
berat = '$_POST[berat]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Barang berhasil ditambahkan'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Barang tidak berhasil ditambahkan'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function update_barang($id)
    {
        global $koneksi;
        $arrcheckpost = array(
            'name' => '',
            'harga' => '',
            'qty' => '',
            'satuan' => '',
            'berat' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "UPDATE barangs SET
name = '$_POST[name]',
harga = '$_POST[harga]',
qty = '$_POST[qty]',
satuan = '$_POST[satuan]',
berat = '$_POST[berat]'
WHERE id='$id'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Update barang berhasil'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Update Barang gagal'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function delete_barang($id)
    {
        global $koneksi;
        $query = "DELETE FROM barangs WHERE id=" . $id;
        if (mysqli_query($koneksi, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Hapus barang berhasil'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Hapus barang gagal'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}