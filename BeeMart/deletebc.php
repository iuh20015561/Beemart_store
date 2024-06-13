<?php
    header('Content-Type: text/html; charset=UTF-8');
    $SpID = $_GET['SpID'];

    $conn = new mysqli('localhost', 'root', '', 'beemart' );

    $sql = "DELETE FROM baocaobanhang WHERE SpID = $SpID";
    $result = $conn->query($sql);

    if($result){
        echo"<script>alert('Xóa dữ liệu thành công')</script>";
        echo header("refresh:0;url='taobaocao.php'");
        // echo "Đã xóa thành công";
    } else {
        echo "Lỗi";
    }

?>