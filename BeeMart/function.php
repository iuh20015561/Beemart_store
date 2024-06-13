<?php
include_once("class.php");

class funcSelect
{
    function getAllSanPham()
    {
        $c = new BeeMart();
        $conn = $c->ketnoi();

        if (!$conn) {
            // Xử lý lỗi kết nối
            die("Connection failed: " . $c->getLastError());
        }

        $query = "SELECT * FROM sanPham";
        $result = $conn->query($query);

        // Kiểm tra trước khi fetch
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Query failed: " . $conn->error);
        }

        // Tạo một mảng để lưu kết quả
        $sanPham = array();

        // Lấy dữ liệu từ kết quả truy vấn
        while ($row = $result->fetch_assoc()) {
            $sanPham[] = $row;
        }

        // Đóng kết nối và trả về kết quả
        $c->dongKetNoi($conn);
        return $sanPham;
    }
}
