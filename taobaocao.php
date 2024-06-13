<?php
    include_once("export_data_to_csv/dbConfig.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo báo cáo bán hàng</title>
  <link rel="stylesheet" href="css/admin/style1.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
  <header class="header">
    <div class="header-left">
      <h2>Bee Mart</h2>
    </div>
  </header>


  <div class="col-md-6">
    <h2>Tạo báo cáo bán hàng</h2>
    <form action="xulybc.php" method="post">
      Mã sản phẩm <input type="text" name="product_code" class="form-control" required="">
      Số lượng tồn kho <input type="number" name="inventory_quantity" class="form-control" required="" readonly>
      Số lượng đã bán <input type="number" name="sold_quantity" class="form-control" readonly>
      Giá bán <input type="number" name="price" class="form-control" readonly>
      <input type="submit" class="btn btn-block btn-danger" value="Tạo báo cáo">
      <a href="admin.php"><input type="button" class="btn btn-block btn-primary" value="Quay lại"></input></a>
    </form>
  </div>


  <div class="container mt-5">
    <h3>Báo cáo bán hàng</h3>
    <div>
      <div class="float-right">
        <a class="btn btn-success export-btn" href="./export_data_to_csv/export.php"><i class="dwn">Export</i></a>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>STT</th>
        <th>Mã sản phẩm</th>
        <th>Tháng bán hàng</th>
        <th>Số lượng tồn kho</th>
        <th>Số lượng đã bán</th>
        <th>Giá bán</th>
        <th>Sửa</th>
        <th>Xóa</th>
      </tr>
      <?php
                $conn = new mysqli('localhost','root', '', 'beemart');
                $sql = "SELECT * FROM baocaobanhang";
                $result = $conn->query($sql);
                $stt = 1;
                while($row = $result ->fetch_assoc()){  
                    echo" 
                    <tr>
                    <td>".$stt++."</td>
                    <td>".$row['maSanPham']."</td>
                    <td>".$row['thangBanHang']."</td>
                    <td>".$row['soLuongTonKho']."</td>
                    <td>".$row['soLuongDaBan']."</td>
                    <td>".$row['giaBan']."</td>
                    <td><a href='suabc.php?SpID=".$row['SpID']."'>Sửa</a></td>
                    <td><a href='deletebc.php?SpID=".$row['SpID']."'>Xóa</a></td>
                </tr>";
                }
            ?>


    </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
  $(document).ready(function() {
    $('input[name="product_code"]').on('change', function() {
      var productCode = $(this).val();
      $.ajax({
        url: 'get_product_data.php',
        type: 'POST',
        data: {
          product_code: productCode
        },
        success: function(data) {
          var jsonData = JSON.parse(data);

          if (jsonData.success) {
            $('input[name="inventory_quantity"]').val(jsonData.inventory_quantity);
            $('input[name="sold_quantity"]').val(jsonData.sold_quantity);
            $('input[name="price"]').val(jsonData.price);

            $('input[type="submit"]').prop('disabled', false);
          } else {
            alert('Mã sản phẩm không tồn tại. Vui lòng nhập lại.');

            $('input[type="submit"]').prop('disabled', true);

          }
        }
      });
    });
  });
  </script>

</body>

</html>