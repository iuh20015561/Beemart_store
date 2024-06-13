var currentuser; // user hiện tại, biến toàn cục
window.onload = function () {
  khoiTao();

  // autocomplete cho khung tim kiem
  autocomplete(document.getElementById("search-box"), list_products);

  // thêm tags (từ khóa) vào khung tìm kiếm
  var tags = ["Panasonic", "Senko", "Sharp"];
  for (var t of tags) addTags(t, "index.php?search=" + t);

  currentuser = getCurrentUser();
  addProductToTable(currentuser);
};

function addProductToTable(user) {
  var table = document.getElementsByClassName("listSanPham")[0];

  var s = `
		<tbody>
			<tr>
				<th>STT</th>
				<th>Sản phẩm</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Giá sau thuế (10%)</th>
				<th>Thời gian</th>
				<th>Xóa</th>
			</tr>`;

  if (!user) {
    return checkTaiKhoan();
  } else if (user.products.length == 0) {
    s += `
			<tr>
				<td colspan="7"> 
					<h1 style="color: #008ECC; background-color:white; font-weight:bold; text-align:center; padding: 15px 0;">
						Giỏ hàng đang trống !!!
					</h1> 
				</td>
			</tr>
		`;
    table.innerHTML = s;
    return;
  }

  var totalPrice = 0;
  for (var i = 0; i < user.products.length; i++) {
    var masp = user.products[i].ma;
    var soluongSp = user.products[i].soluong;
    var p = timKiemTheoMa(list_products, masp);
    var price = p.promo.name == "giareonline" ? p.promo.value : p.price;
    var thoigian = new Date(user.products[i].date).toLocaleString();
    var thanhtien = (stringToNum(price) + stringToNum(price) * 0.1) * soluongSp;

    s +=
      `
			<tr>
				<td>` +
      (i + 1) +
      `</td>
				<td class="noPadding imgHide">
					<a target="_blank" href="chitietsanpham.php?` +
      p.name.split(" ").join("-") +
      `" title="Xem chi tiết">
						` +
      p.name +
      `
						<img src="` +
      p.img +
      `">
					</a>
				</td>
				<td class="alignRight">` +
      price +
      ` ₫</td>
				<td class="soluong" >
					<button onclick="giamSoLuong('` +
      masp +
      `')"><i class="fa fa-minus"></i></button>
					<input size="1" onchange="capNhatSoLuongFromInput(this, '` +
      masp +
      `')" value=` +
      soluongSp +
      `>
					<button onclick="tangSoLuong('` +
      masp +
      `')"><i class="fa fa-plus"></i></button>
				</td>
				<td class="alignRight">` +
      numToString(thanhtien) +
      ` ₫</td>
				<td style="text-align: center" >` +
      thoigian +
      `</td>
				<td class="noPadding"> <i class="fa fa-trash" onclick="xoaSanPhamTrongGioHang(` +
      i +
      `)"></i> </td>
			</tr>
		`;
    // Chú ý nháy cho đúng ở giamsoluong, tangsoluong
    totalPrice += thanhtien;
  }

  s +=
    `
			<tr style="font-weight:bold; text-align:center">
				<td colspan="4">TỔNG TIỀN: </td>
				<td class="alignRight">` +
    numToString(totalPrice) +
    ` ₫</td>
				<td class="thanhtoan" onclick="document.getElementById('myModal').style.display='flex'"> Thanh Toán </td>
				<td class="xoaHet" onclick="xoaHet()"> Xóa hết </td>
			</tr>
		</tbody>
	`;

  table.innerHTML = s;
}

function xoaSanPhamTrongGioHang(i) {
  if (window.confirm("Xác nhận hủy mua")) {
    currentuser.products.splice(i, 1);
    capNhatMoiThu();
  }
}

function xacnhanthanhtoan() {
  currentuser.donhang.push({
    sp: currentuser.products,
    ngaymua: new Date(),
    tinhTrang: "Đã thanh toán",
  });
  currentuser.products = [];
  capNhatMoiThu();
}
// Đóng modal nếu click ra ngoài modal
window.onclick = function (event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    modal.style.display = "none";
    modal.classList.remove("large-modal");
  }
};

function xoaHet() {
  if (currentuser.products.length) {
    if (window.confirm("Quý khách có chắc chắn muốn xóa hết sản phẩm trong giỏ hàng !!!")) {
      currentuser.products = [];
      capNhatMoiThu();
    }
  }
}

// Cập nhật số lượng lúc nhập số lượng vào input
function capNhatSoLuongFromInput(inp, masp) {
  var soLuongMoi = Number(inp.value);
  if (!soLuongMoi || soLuongMoi <= 0) soLuongMoi = 1;

  for (var p of currentuser.products) {
    if (p.ma == masp) {
      p.soluong = soLuongMoi;
    }
  }

  capNhatMoiThu();
}

function tangSoLuong(masp) {
  for (var p of currentuser.products) {
    if (p.ma == masp) {
      p.soluong++;
    }
  }

  capNhatMoiThu();
}

function giamSoLuong(masp) {
  for (var p of currentuser.products) {
    if (p.ma == masp) {
      if (p.soluong > 1) {
        p.soluong--;
      } else {
        return;
      }
    }
  }

  capNhatMoiThu();
}

function capNhatMoiThu() {
  // Mọi thứ
  animateCartNumber();

  // cập nhật danh sách sản phẩm trong localstorage
  setCurrentUser(currentuser);
  updateListUser(currentuser);

  // cập nhật danh sách sản phẩm ở table
  addProductToTable(currentuser);

  // Cập nhật trên header
  capNhat_ThongTin_CurrentUser();
}
