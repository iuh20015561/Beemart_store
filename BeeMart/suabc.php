<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa báo cáo bán hàng</title>
    <link rel="stylesheet" href="css/admin/style1.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
$SpID = $_GET["SpID"];
$product_code="";
$inventory_quantity="";
$sold_quantity="";
$price="";
$conn = new mysqli('localhost', 'root', '', 'beemart');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM baocaobanhang WHERE SpID = $SpID");

while ($row = mysqli_fetch_array($result)) {
    $product_code = $row["maSanPham"];
    $inventory_quantity = $row["soLuongTonKho"];
    $sold_quantity = $row["soLuongDaBan"];
    $price = $row["giaBan"];
}
?>

<header class="header">
    <div class="header-left">
        <h2>Bee Mart</h2>
    </div>    
</header>

<div class="col-md-6">
    <div>
        <div>
            <div>
                <div>
                    <h5>Sửa báo cáo bán hàng</h5>
                </div>
                <div>
                    <form action="editsuabc.php?SpID=<?php echo $SpID; ?>" method="post">
                        <div class="control-group">
                            <label class="control-label">Mã sản phẩm:</label>
                            <div class="controls">
                                <input type="text" name="product_code" class="form-control" value="<?php echo $product_code; ?>" readonly>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Số lượng tồn kho:</label>
                            <div class="controls">
                                <input type="text" name="inventory_quantity" class="form-control" value="<?php echo $inventory_quantity; ?>" readonly>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Số lượng đã bán:</label>
                            <div class="controls">
                                <input type="text" name="sold_quantity" class="form-control" value="<?php echo $sold_quantity; ?>" readonly>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Giá bán:</label>
                            <div class="controls">
                                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">Số lượng cần nhập kho:</label>
                            <div class="controls">
                                <input type="text" name="quantity_to_add" class="form-control" required>
                            </div>
                        </div>
                        
                        <input type="submit" class="btn btn-block btn-danger text-uppercase font-weight-bold" value="CẬP NHẬT">
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>

