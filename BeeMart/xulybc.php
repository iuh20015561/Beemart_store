<?php
    header('Content-Type: text/html; charset=UTF-8');

    $product_code = $_POST['product_code'];
    // $selling_month = $_POST['selling_month'];
    $inventory_quantity = $_POST['inventory_quantity'];
    $sold_quantity = $_POST['sold_quantity'];
    $price = $_POST['price'];
    
    // echo "Mã sản phẩm: " . $product_code . "<br>";
    // // echo "Tháng bán hàng: " . $selling_month . "<br>";
    // echo "Số lượng tồn kho: " . $inventory_quantity . "<br>";
    // echo "Số lượng đã bán: " . $sold_quantity . "<br>";
    // echo "Giá bán: " . $price . "<br>";

    //Đưa dữ liệu vào bảng
    //Kết nối với csdl
    $conn = new mysqli('localhost', 'root', '', 'beemart');

    // chèn dữ liệu
    
    
    $sql = "INSERT INTO baocaobanhang (maSanPham, soLuongTonKho, soLuongDaBan, giaBan) 
    VALUES ('$product_code', '$inventory_quantity', '$sold_quantity', '$price')";

    $result = $conn->query($sql);
    if($result) {
        echo"<script>alert('Đã tạo báo cáo thành công')</script>";
        echo header("refresh:0;url='taobaocao.php'");
        // echo 'Đã tạo báo cáo thành công';
        // header('Location: http://localhost:8080/ProjectBeeMart/taobaocao.php?catagory=');
    } else {
        echo 'Không tạo được';
    }
    // Đóng kết nối
    $conn->close();
?>