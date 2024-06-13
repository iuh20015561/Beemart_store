<?php
    header('Content-Type: text/html; charset=UTF-8');

    $product_code = $_POST['product_code'];
    $inventory_quantity = $_POST['inventory_quantity'];
    $sold_quantity = $_POST['sold_quantity'];
    $price = $_POST['price'];
    $conn = new mysqli('localhost', 'root', '', 'beemart');    
    
    $sql = "INSERT INTO baocaobanhang (maSanPham, soLuongTonKho, soLuongDaBan, giaBan) 
    VALUES ('$product_code', '$inventory_quantity', '$sold_quantity', '$price')";

    $result = $conn->query($sql);
    if($result) {
        echo"<script>alert('Đã tạo báo cáo thành công')</script>";
        echo header("refresh:0;url='taobaocao.php'");
    } else {
        echo 'Không tạo được';
    }
    $conn->close();
?>