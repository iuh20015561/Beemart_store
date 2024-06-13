<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bee Mart</title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        crossorigin="anonymous">

    <!-- owl carousel libraries cho hình nhỏ -->
    <link rel="stylesheet" href="js/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="js/owlcarousel/owl.theme.default.min.css">
    <script src="js/Jquery/Jquery.min.js"></script>
    <script src="js/owlcarousel/owl.carousel.min.js"></script>

    <!-- our files -->
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/topnav.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/taikhoan.css">
    <link rel="stylesheet" href="css/trangchu.css">
    <link rel="stylesheet" href="css/home_products.css">
    <link rel="stylesheet" href="css/chitietsanpham.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- js -->
    <script src="data/products.js"></script>
    <script src="js/classes.js"></script>
    <script src="js/dungchung.js"></script>
    <!-- <script src="js/chitietsanpham.js"></script> -->
</head>

<body>
    <?php
  include("class.php");
  $p = new BeeMart();
  ?>

    <script>
    addTopNav();
    </script>

    <section>
        <script>
        addHeader();
        </script>
        <div id="productNotFound" style="min-height: 50vh; text-align: center; margin: 50px; display: none;">
            <h1 style="color: red; margin-bottom: 10px;">Không tìm thấy sản phẩm</h1>
            <a href="index.php" style="text-decoration: underline;">Quay lại trang chủ</a>
        </div>

        <div class="chitietSanpham">
            <div class="left">
                <h1>Thông Tin Sản Phẩm </h1>
                <?php
        include_once("function.php");
        $f = new funcSelect();
        $tblSP = $f->getAllSanPham();
        $fullUrl = $_SERVER['REQUEST_URI'];

        // Phân tích URL để lấy phần đuôi
        if (preg_match("/\?(\d+)$/", $fullUrl, $matches)) {
          $number = $matches[1];
          // echo "Số từ đường link là: $number";
        } else {
            echo "Không có sản phẩm nào.";
        }
        if ($tblSP) {
          if (count($tblSP) > 0) {
            foreach ($tblSP as $row) {
              // Sử dụng thẻ <img> để hiển thị hình ảnh
              if ($row['maSanPham'] == intval($number)) {
              echo "<img class='hinhAnhSanPham' src='img/products/" . htmlspecialchars($row['loaiSanPham']) . "/" . htmlspecialchars($row['hinhAnh']) . "'>";
              break;}
            }
          } else {
            echo "0 result";
          }
        } else {
          echo "Không có giá trị";
        }
        ?>


            </div>

            <div class="right">
                <?php
        include_once("function.php");
        $f = new funcSelect();
        $tblSP = $f->getAllSanPham();

        if ($tblSP) {
          if (count($tblSP) > 0) {
            // Lấy đường link từ URL
            $fullUrl = $_SERVER['REQUEST_URI'];

            // Phân tích URL để lấy phần đuôi
            if (preg_match("/\?(\d+)$/", $fullUrl, $matches)) {
              $number = $matches[1];
              // echo "Số từ đường link là: $number";
            } else {
                echo "Không có sản phẩm nào.";
            }
            // $productId = null;
            // if (isset($urlParts['query'])) {
            //     // Lấy phần query string từ URL
            //     $queryString = $urlParts['query'];

            //     // Phân tách các tham số trong query string
            //     parse_str($queryString, $queryParams);

            //     // Lấy giá trị của tham số có tên 'id' (hoặc tùy theo tên tham số của bạn)
            //     if (isset($queryParams['maProduct'])) {
            //         $productId = $queryParams['maProduct'];
            //         echo "Phần đuôi của đường link là: " . $productId;
            //     } else {
            //         echo "Không có sản phẩm nào.2";
            //     }
            // } else {
            //     echo "Không có sản phẩm nào.1";
            // }
            $productFound=false;
              foreach ($tblSP as $row) {
                  if ($row['maSanPham'] == intval($number)) {
                      echo "<h1 class='tensp'>" . $row["tenSanPham"] . "</h1>";
                      echo "<h2 class='giasp'>" . htmlspecialchars(number_format($row["giaBan"])) . " VND</h2>";
  
                      echo "
                      <div class='area_order'>
                          <a class='buy_now' onclick='themVaoGioHang(".strval($row['maSanPham']).", \"".$row['tenSanPham']."\");'>
                              <b><i class='fa fa-cart-plus'></i> Thêm vào giỏ hàng</b>
                          </a>
                      </div>
                      ";
                      echo "<p class='gioithieu'>" . $row["moTaSanPham"] . "</p>";
  
                      $productFound = true;
                      break;
                      
                  }
              }
    
            if (!$productFound) {
                // Không tìm thấy sản phẩm với mã sản phẩm cung cấp
                echo "Không tìm thấy sản phẩm 1";
            }
    

          } else {
              // Hiển thị thông báo khi không có kết quả
              echo "Không có kết quả";
          }
      } else {
          // Hiển thị thông báo khi không có giá trị
          echo "Không có giá trị";
      }
      
        ?>


            </div>

        </div>
    </section>

    <script>
    addContainTaiKhoan();
    </script>

    <div class="footer">
        <script>
        addFooter();
        </script>
    </div>

</body>

</html>