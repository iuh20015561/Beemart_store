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
    <h2>Dự đoán số lượng hàng</h2>
    <form action="submitdudoan.php" method="post">
      <br>
      <br>
      <input type="submit" class="btn btn-block btn-danger" value="Dự đoán">
      <a href="admin.php"><input type="button" class="btn btn-block btn-primary" value="Quay lại"></input></a>
    </form>
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