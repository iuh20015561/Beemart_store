<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bee Mart</title>
  <link rel="shortcut icon" href="img/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <link rel="stylesheet" href="css/admin/style.css">
  <link rel="stylesheet" href="css/admin/progress.css">
  <script src="data/products.js"></script>
  <script src="js/classes.js"></script>
  <script src="js/dungchung.js"></script>
  <script src="js/admin.js"></script>
</head>

<body>
  <header class="header">
    <div class="header-left">
      <h2>Bee Mart</h2>
      <a href="taobaocao.php"><button class="dudoan" id="taobaocao">Tạo báo cáo</button></a>
      <a href="dudoan.php"><button class="dudoan" id="dudoan">Dự đoán</button></a>
    </div>
    <div class="header-right">
      <div class="avt-nhanvien"><i class="fa fa-user"></i></div>
    </div>
  </header>

  <aside class="sidebar">
    <ul class="nav">
      <li class="nav-title">MENU</li>
      <li class="nav-item"><a class="nav-link active"><i class="fa fa-home"></i> Trang Chủ</a></li>
      <li class="nav-item"><a class="nav-link"><i class="fa fa-th-large"></i> Sản Phẩm</a></li>
      <li class="nav-item"><a class="nav-link"><i class="fa fa-file-text-o"></i> Đơn Hàng</a></li>
      <li class="nav-item"><a class="nav-link"><i class="fa fa-address-book-o"></i> Khách Hàng</a></li>
      <li class="nav-item">
        <hr>
      </li>
      <li class="nav-item">
        <a href="index.php" class="nav-link" onclick="logOutAdmin(); return true;">
          <i class="fa fa-arrow-left"></i>
          Đăng xuất (về Trang chủ)
        </a>
      </li>
    </ul>
  </aside>

  <div class="main">
    <div class="home">
      <div class="canvasContainer">
        <canvas id="myChart1"></canvas>
      </div>
      <div class="canvasContainer">
        <canvas id="myChart2"></canvas>
      </div>
      <div class="canvasContainer">
        <canvas id="myChart3"></canvas>
      </div>
      <div class="canvasContainer">
        <canvas id="myChart4"></canvas>
      </div>
    </div>

    <div class="sanpham">
      <table class="table-header">
        <tr>
          <th title="Sắp xếp" style="width: 5%" onclick="sortProductsTable('stt')">Stt <i class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 10%" onclick="sortProductsTable('masp')">Mã <i class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 40%" onclick="sortProductsTable('ten')">Tên <i class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 15%" onclick="sortProductsTable('gia')">Giá <i class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 15%" onclick="sortProductsTable('khuyenmai')">Khuyến mãi <i
              class="fa fa-sort"></i></th>
          <th style="width: 15%">Hành động</th>
        </tr>
      </table>
      <div class="table-content"></div>
      <div class="table-footer">
        <select name="kieuTimSanPham">
          <option value="ma">Tìm theo mã</option>
          <option value="ten">Tìm theo tên</option>
        </select>
        <input type="text" placeholder="Tìm kiếm..." onkeyup="timKiemSanPham(this)">
      </div>
      <div id="khungThemSanPham" class="overlay"></div>
      <div id="khungSuaSanPham" class="overlay"></div>
    </div>

    <div class="donhang">
      <table class="table-header">
        <tr>
          <th title="Sắp xếp" style="width: 5%" onclick="sortDonHangTable('stt')">Stt <i class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 13%" onclick="sortDonHangTable('madon')">Mã đơn <i class="fa fa-sort"></i>
          </th>
          <th title="Sắp xếp" style="width: 7%" onclick="sortDonHangTable('khach')">Khách <i class="fa fa-sort"></i>
          </th>
          <th title="Sắp xếp" style="width: 20%" onclick="sortDonHangTable('sanpham')">Sản phẩm <i
              class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 15%" onclick="sortDonHangTable('tongtien')">Tổng tiền <i
              class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 10%" onclick="sortDonHangTable('ngaygio')">Ngày giờ <i
              class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 10%" onclick="sortDonHangTable('trangthai')">Trạng thái <i
              class="fa fa-sort"></i></th>
          <th style="width: 10%">Hành động</th>
        </tr>
      </table>
      <div class="table-content"></div>
      <div class="table-footer">
        <div class="timTheoNgay">
          Từ ngày: <input type="date" id="fromDate">
          Đến ngày: <input type="date" id="toDate">
          <button onclick="locDonHangTheoKhoangNgay()"><i class="fa fa-search"></i> Tìm</button>
        </div>
        <select name="kieuTimDonHang">
          <option value="ma">Tìm theo mã đơn</option>
          <option value="khachhang">Tìm theo tên khách hàng</option>
          <option value="trangThai">Tìm theo trạng thái</option>
        </select>
        <input type="text" placeholder="Tìm kiếm..." onkeyup="timKiemDonHang(this)">
      </div>
    </div>

    <div class="khachhang">
      <table class="table-header">
        <tr>
          <th title="Sắp xếp" style="width: 5%" onclick="sortKhachHangTable('stt')">Stt <i class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 15%" onclick="sortKhachHangTable('hoten')">Họ tên <i class="fa fa-sort"></i>
          </th>
          <th title="Sắp xếp" style="width: 20%" onclick="sortKhachHangTable('email')">Email <i class="fa fa-sort"></i>
          </th>
          <th title="Sắp xếp" style="width: 20%" onclick="sortKhachHangTable('taikhoan')">Tài khoản <i
              class="fa fa-sort"></i></th>
          <th title="Sắp xếp" style="width: 10%" onclick="sortKhachHangTable('matkhau')">Mật khẩu <i
              class="fa fa-sort"></i></th>
          <th style="width: 10%">Hành động</th>
        </tr>
      </table>
      <div class="table-content"></div>
      <div class="table-footer">
        <select name="kieuTimKhachHang">
          <option value="ten">Tìm theo họ tên</option>
          <option value="email">Tìm theo email</option>
          <option value="taikhoan">Tìm theo tài khoản</option>
        </select>
        <input type="text" placeholder="Tìm kiếm..." onkeyup="timKiemNguoiDung(this)">
        <button onclick="openThemNguoiDung()"><i class="fa fa-plus-square"></i> Thêm người dùng</button>
      </div>
    </div>
  </div>

  <footer></footer>
</body>

</html>