<?php
$conn = new mysqli('localhost', 'root', '', 'beemart');
$productCode = $_POST['product_code'];

$sql = "SELECT soLuongTonKho, soLuongDaBan, giaBan FROM baocaobanhang WHERE maSanPham = '$productCode'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['success'] = true;
    $response['inventory_quantity'] = $row['soLuongTonKho'];
    $response['sold_quantity'] = $row['soLuongDaBan'];
    $response['price'] = $row['giaBan'];
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
