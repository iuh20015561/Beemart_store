<?php
class BeeMart
{
    private $lastError; // Thêm biến lastError vào class để lưu trữ thông báo lỗi

    function ketnoi()
    {
        // Tạo kết nối sử dụng MySQLi
        $conn = new mysqli("localhost", "root", "", "beemart"); // Sửa lại tên người dùng MySQL

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            $this->lastError = "Không kết nối được: " . $conn->connect_error; // Gán giá trị lastError khi có lỗi
            return false;
        }

        // Thiết lập charset
        $conn->set_charset("utf8");

        return $conn;
    }

    function dongKetNoi($con)
    {
        // Đóng kết nối
        $con->close();
    }

    function getLastError()
    {
        return $this->lastError;
    }
}
