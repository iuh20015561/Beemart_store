<?php
header('Content-Type: text/html; charset=UTF-8');

$SpID = $_GET['SpID'];
$eproduct_code = $_POST['product_code'];
$einventory_quantity = $_POST['inventory_quantity'];
$esold_quantity = $_POST['sold_quantity'];
$eprice = $_POST['price'];
$quantity_to_add = $_POST['quantity_to_add'];

$conn = new mysqli('localhost', 'root', '', 'beemart');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT soLuongTonKho FROM baocaobanhang WHERE SpID = $SpID");

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_inventory_quantity = $row['soLuongTonKho'];

    $new_inventory_quantity = $current_inventory_quantity + $quantity_to_add;

    $sql = "UPDATE baocaobanhang SET maSanPham = '$eproduct_code',
                            soLuongTonKho = '$new_inventory_quantity',
                            soLuongDaBan = '$esold_quantity',
                            giaBan = '$eprice' WHERE SpID = $SpID ";

    $result = $conn->query($sql);

    if ($result) {
        echo "<script>alert('Cập nhật dữ liệu thành công')</script>";
        echo header("refresh:0;url='taobaocao.php'");
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
    }
} else {
    echo "Lỗi khi truy vấn dữ liệu: " . $conn->error;
}

$conn->close();
?>