<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Liên hệ - Bee Mart</title>
  <link rel="shortcut icon" href="img/favicon.ico" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/topnav.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/taikhoan.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/lienhe.css">


  <script src="data/products.js"></script>
  <script src="js/dungchung.js"></script>
  <script src="js/lienhe.js"></script>

</head>

<body>
  <script>
  addTopNav();
  </script>

  <section style="min-height: 85vh">
    <script>
    addHeader();
    </script>

    <div class="body-lienhe">
      <div class="lienhe-header">Liên hệ</div>
      <div class="lienhe-info">
        <div class="info-left">
          <p>
          <h2><span>CÔNG TY </span><span class="yellow-text"> Bee</span><span class="blue-text">Mart</span>
          </h2><br>
          <b>Địa chỉ:</b> 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, Thành phố Hồ Chí Minh <br /><br />
          <b>Số điện thoại:</b> 098 7654 321<br /><br />
          <b>Hotline:</b> 099 9999 999 - CSKH: 098 7654 321<br /><br />
          <b>Website:</b> <a href="index.php">BeeMart.com</a> <br /><br />
          <b>E-mail:</b> beemart@gmail.com<br /><br />
          <b>Quý khách có thể gửi liên hệ tới chúng tôi bằng cách hoàn tất biểu mẫu dưới đây. Chúng tôi sẽ trả
            lời thư của quý khách, xin vui lòng khai báo đầy đủ. Hân hạnh phục vụ và chân thành cảm ơn sự
            quan tâm, đóng góp ý kiến đến BeeMart.</b>
          </p>
        </div>
        <div class="info-right">
          <iframe width="100%" height="450"
            src="https://maps.google.com/maps?width=100%&amp;height=450&amp;hl=en&amp;coord=YOUR_NEW_COORDINATES&amp;q=12%20Nguy%E1%BB%85n%20V%C4%83n%20B%E1%BA%A3o%2C%20Ph%C6%B0%E1%BB%9Dng%204%2C%20Qu%E1%BA%ADn%20G%C3%B2%20V%E1%BA%A5p%2C%20Th%C3%A0nh%20ph%E1%BB%91%20H%E1%BB%93%20Ch%C3%AD%20Minh&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=B&amp;output=embed"
            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
              href="https://www.maps.ie/create-google-map/">Embed
              Google Map
            </a>
          </iframe>
          <br />
        </div>
      </div>
      <div class="lienhe-info">

        <div class="guithongtin">
          <p style="font-size: 22px; color: gray">Gửi thông tin liên lạc cho chúng tôi: </p>
          <hr />
          <form name="formlh" onsubmit="return nguoidung()">
            <table cellspacing="10px">
              <tr>
                <td>Họ và tên</td>
                <td><input type="text" name="ht" size="40" maxlength="40" placeholder="Họ tên" autocomplete="off"
                    required></td>
              </tr>
              <tr>
                <td>Số điện thoại</td>
                <td><input type="text" name="sdt" size="40" maxlength="11" minlength="10" placeholder="Điện thoại"
                    required></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><input type="email" name="em" size="40" placeholder="Email" autocomplete="off" required></td>
              </tr>
              <tr>
                <td>Tiêu đề</td>
                <td><input type="text" name="tde" size="40" maxlength="100" placeholder="Tiêu đề" required>
              </tr>
              <tr>
                <td>Nội dung</td>
                <td><textarea name="nd" rows="5" cols="44" maxlength="500" wrap="physical"
                    placeholder="Nội dung liên hệ" required></textarea></td>
              </tr>
              <tr>
                <td></td>
                <td><button type="submit">Gửi thông tin liên hệ</button></td>
              </tr>
            </table>
          </form>
        </div>
        <div class="thongtinnhom">
          <p style="font-size: 22px; color: #008ECC">Thông tin thành viên nhóm: </p>
          <hr />
          <table>
            <tr>
              <th style="width: 40%">Họ tên</th>
              <th style="width: 30%">MSSV</th>
              <th style="width: 30%">Lớp</th>
            </tr>
            <script>
            var thongtin = [
              ["Lê Phước Nguyên", "20022651", "DHHTTT16A"],
              ["Nguyễn Tấn Dự", "21004425", "DHKTPM17A"],
              ["Trần Tấn Phát", "20015561", "DHHTTT16A"],
              ["Trần Lê Cảnh", "19504391", "DHHTTT15"],
              ["Nguyễn Văn Dương", "20029511", "DHHTTT16A"],
              ["Trần Quốc Nhật", "20051251", "DHHTTT16A"]
            ]
            for (var i = 0; i < thongtin.length; i++) {
              document.write(
                `
                                    <tr>
                                        <td>` +
                thongtin[i][0] + `</td>
                                        <td>` +
                thongtin[i][1] + `</td>
                                        <td>` +
                thongtin[i][2] + `</td>
                                    </tr>
                                `
              )
            }
            </script>
          </table>
        </div>

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

  <i class="fa fa-arrow-up" id="goto-top-page" onclick="gotoTop()"></i>

</body>

</html>