<?php
include_once("class.php");

class funcSelect
{
    function getAllSanPham()
    {
        $c = new BeeMart();
        $conn = $c->ketnoi();

        if (!$conn) {
            die("Connection failed: " . $c->getLastError());
        }

        $query = "SELECT * FROM sanPham";
        $result = $conn->query($query);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        $sanPham = array();

        while ($row = $result->fetch_assoc()) {
            $sanPham[] = $row;
        }

        $c->dongKetNoi($conn);
        return $sanPham;
    }
}