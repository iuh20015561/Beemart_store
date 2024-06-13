<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="img/favicon.ico" />

  <title>Giỏ hàng Bee Mart</title>

  <!-- Load font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    crossorigin="anonymous">


  <!-- our files -->
  <!-- css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/topnav.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/taikhoan.css">
  <link rel="stylesheet" href="css/gioHang.css">
  <link rel="stylesheet" href="css/footer.css">
  <!-- js -->
  <script src="data/products.js"></script>
  <script src="js/classes.js"></script>
  <script src="js/dungchung.js"></script>
  <script src="js/giohang.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
  <script>
  addTopNav();
  </script>

  <section style="min-height: 85vh">
    <script>
    addHeader();
    </script>

    <table class="listSanPham"> </table>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <!-- Nội dung của modal -->
        <h2>Nhập thông tin đặt hàng và thanh toán</h2>
        <!-- Thêm các trường nhập thông tin thanh toán ở đây -->

        <!-- Form nhập thông tin thanh toán -->
        <form>
          <div class="row">
            <div class="col-md-6">
              <!-- Cột 1 -->
              <div class="form-group">
                <input type="text" class="form-control" id="hoTen" placeholder=" " required />
                <label for="hoTen" class="label" id="hoTen">Họ và tên <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Cột 2 -->
              <div class="form-group">
                <input type="tel" class="form-control" id="soDienThoai" placeholder=" " required />
                <label for="soDienThoai" class="label" id="soDienThoai">Số điện thoại <span
                    class="form-message danger">*</span>
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <!-- Cột 1 -->
              <div class="form-group">
                <input type="text" class="form-control" id="diaChi" placeholder=" " required />
                <label for="diaChi" class="label" id="diaChi">Địa chỉ <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Cột 2 -->
              <div class="form-group">
                <input type="email" class="form-control" placeholder=" " id="email" />
                <label for="Email" class="label">Email <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <!-- Cột 1 -->
              <div class="form-group">
                <input type="text" class="form-control" placeholder=" " id="soTheTinDung" required />
                <label for="soTheTinDung" class="label">Số thẻ Tín Dụng <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Cột 2 -->
              <div class="form-group">

                <select class="form-control" id="loaiThe" required>
                  <option value="">Chọn loại thẻ</option>
                  <option value="1">Visa</option>
                  <option value="2">MasterCard</option>
                  <option value="3">PayPal</option>
                </select>
                <label for="loaiThe" class="label">Loại thẻ <span class="form-message danger">*</span>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <!-- Cột 1 -->
              <div class="form-group">
                <input type="text" class="form-control" id="tenChuThe" placeholder=" " required />
                <label for="tenChuThe" class="label">Tên chủ thẻ <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Cột 2 -->
              <div class="form-group">
                <input type="text" class="form-control" id="ngayHetHan" placeholder=" " required />
                <label for="ngayHetHan" class="label">Ngày hết hạn <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <!-- Cột 1 -->
              <div class="form-group">
                <input type="text" class="form-control" id="maCVV" placeholder=" " required />
                <label for="maCVV" class="label">Mã CVV <span class="form-message danger">*</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Cột 2 -->
              <div class="form-group" id="Button">
                <button class="btn btn-secondary" type="reset">Hủy</button>
                <button type="submit" id="btnCheck" class="btn btn-primary">Xác nhận</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
    $(document).ready(function() {
      $(".btn-secondary").click(function() {
        $('myModal').style.display = 'none';
        $(".form-message").text("*");
      });

      function validateInput(input, regex, errorMessage) {
        var formMessage = input.next().find(".form-message");
        if (input.val().length === 0 || input.val() === 0) {
          formMessage.show();
          formMessage.text("Không thể bỏ trống");
          return false;
        }

        if (!regex.test(input.val())) {
          formMessage.show();
          formMessage.text(errorMessage);
          return false;
        }

        formMessage.text("*");
        return true;
      }

      function regexHoTen() {
        var regex =
          /^[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ'-'\s]*$/;
        return validateInput($("#hoTen"), regex, "Sai định dạng họ tên");
      }

      $("#hoTen").blur(regexHoTen);

      function regexHoTenChuThe() {
        var regex = /^[a-zA-Z'-'\s]*$/;
        return validateInput($("#tenChuThe"), regex, "Sai định dạng tên chủ thẻ");
      }

      $("#tenChuThe").blur(regexHoTenChuThe);

      function regexSDT() {
        var regex = /^0\d{9}$/;
        return validateInput($("#soDienThoai"), regex, "Sai định dạng số điện thoại");
      }

      $("#soDienThoai").blur(regexSDT);

      function regexEmail() {
        var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return validateInput($("#email"), regex, "Sai định dạng email");
      }

      $("#email").blur(regexEmail);

      function regexSoTheTinDung() {
        var regex =
          /^4[0-9]{3}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}|5[1-5][0-9]{2}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}|(4[0-9]{15}|5[1-5][0-9]{14}|(4[0-9]{15}|5[1-5][0-9]{14}))$/;
        return validateInput($("#soTheTinDung"), regex, "Sai định dạng số thẻ tín dụng");
      }

      $("#soTheTinDung").blur(regexSoTheTinDung);

      function regexNgayHetHan() {
        var regex = /^(0[1-9]|1[0-2])\/20[2-9][0-9]$/;
        var formMessage = $("#ngayHetHan").next().find(".form-message");

        if ($("#ngayHetHan").val().length === 0 || $("#ngayHetHan").val() === "0") {
          formMessage.show();
          formMessage.text("Không thể bỏ trống");
          return false;
        }

        if (!regex.test($("#ngayHetHan").val())) {
          formMessage.show();
          formMessage.text("Sai định dạng ngày hết hạn");
          return false;
        }

        // Lấy tháng và năm hiện tại
        var currDate = new Date();
        var currentDate = new Date(currDate.getFullYear(), currDate.getMonth());
        // Kiểm tra xem ngày hết hạn có trước ngày hiện tại không
        var dateParts = $("#ngayHetHan").val().split("/");
        var year = parseInt(dateParts[1], 10);
        var month = parseInt(dateParts[0], 10) - 1;

        var inputDate = new Date(year, month);

        if (inputDate < currentDate) {
          formMessage.show();
          formMessage.text("Thẻ đã hết hạn");
          return false;
        }

        // Nếu giá trị hợp lệ, ẩn thông báo lỗi
        formMessage.hide();
        return true;
      }

      $("#ngayHetHan").blur(regexNgayHetHan);

      function regexMaCVV() {
        var regex = /^[0-9]{3}$/;
        return validateInput($("#maCVV"), regex, "Sai định dạng mã CVV");
      }

      $("#maCVV").blur(regexMaCVV);

      function regexDiaChi() {
        var regexDiaChi =
          /^[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ0-9\s,.'-]+$/;
        return validateInput($("#diaChi"), regexDiaChi, "Sai định dạng địa chỉ");
      }

      $("#diaChi").blur(regexDiaChi);

      function regexLoaiThe() {
        var regexLoaiThe = /^[1-3]$/;
        return validateInput($("#loaiThe"), regexLoaiThe, "Chưa chọn loại thẻ");
      }

      $("#loaiThe").blur(regexLoaiThe);

      $("#btnCheck").click(function() {
        if (
          !regexHoTen() ||
          !regexHoTenChuThe() ||
          !regexDiaChi() ||
          !regexSoTheTinDung() ||
          !regexEmail() ||
          !regexSDT() ||
          !regexLoaiThe() ||
          !regexNgayHetHan() ||
          !regexMaCVV()
        ) {
          return;
        }

        // Hiển thị hộp thoại xác nhận
        var confirmation = confirm("Quý khách có chắc chắn muốn thanh toán không?");

        // Nếu người dùng chọn OK, thực hiện xác nhận và gửi đơn hàng
        if (confirmation) {
          xacnhanthanhtoan();
        } else {
          // Người dùng chọn Cancel, ngăn chặn hành động mặc định và giữ nguyên giá trị đã nhập
          event.preventDefault();
        }
      });
    });
    </script>
  </section> <!-- End Section -->

  <script>
  addContainTaiKhoan();
  </script>

  <div class="footer">
    <script>
    addFooter();
    </script>
  </div>

  <i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>
</body>

</html>