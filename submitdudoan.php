<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kết quả dự đoán</title>

  <link rel="stylesheet" href="css/admin/style1.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</head>
<style>

</style>

<body>
  <header class="header">
    <div class="header-left">
      <h2>Bee Mart</h2>
    </div>
  </header>

  <div class="container">
    <div class="" style="text-align:center">
      <h2>Dự đoán số lượng hàng</h2>
    </div>
    <div style="float:right">
      <a href="dudoan.php"><input type="button" class="btn btn-primary" value="Quay lại"></input></a>
    </div>
    <table class="table table-stripped bolder">
      <thead>
      </thead>
    </table>


    <?php
        function callPredAPI()
        {
            $pythonPath = "C:\\Users\\Tan Du\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
            $pythonPath = realpath($pythonPath);
            $cmdline = ' -c "import dudoan; dudoan.main()"';
            $cmd  =  $pythonPath . $cmdline;
            $output = "hello";
            ob_start();
            echo shell_exec($cmd);
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }
        function showRes()
        {
            $conn = new mysqli('localhost', 'root', '', 'beemart');
            $sql = "SELECT * FROM solieududoan";
            $result = $conn->query($sql);
            mysqli_set_charset($conn,"utf8");
            $stt = 1;
            echo "<table class='table table-striped'>";
            echo "<tr>";
            echo "<th>Tên Sản Phẩm</th>";
            echo "<th>Số Lượng Cần Nhập Kho</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                $namequery1 = "SELECT tenSanPham FROM sanpham where maSanPham = ";
                $namequery = $namequery1.$row["maSanPham"];
                $name = $conn->query($namequery)->fetch_assoc();
                echo "<tr>";
                echo "<td>" . $name["tenSanPham"] . "</td>";
                echo "<td>" . $row["soLuongCanNhapKho"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        function main()
        {
            $res = callPredAPI();

            showRes();
        }
        main();
        ?>
  </div>

</body>

</html>