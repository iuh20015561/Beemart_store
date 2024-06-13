var nameProduct, maProduct, sanPhamHienTai;

window.onload = function () {
  khoiTao();

  var tags = ["Panasonic", "Senko", "Sharp"];
  for (var t of tags) addTags(t, "index.php?search=" + t, true);

  phanTich_URL_chiTietSanPham();

  autocomplete(document.getElementById("search-box"), list_products);

  sanPhamHienTai && suggestion();
};

function khongTimThaySanPham() {
  document.getElementById("productNotFound").style.display = "block";
  document.getElementsByClassName("chitietSanpham")[0].style.display = "none";
}

function phanTich_URL_chiTietSanPham() {
  maProduct = window.location.href.split("?")[1];
  if (!maProduct) return khongTimThaySanPham();

  sendUrlParamToPhp(maProduct);

  sanPhamHienTai = timKiemTheoMa(list_products, maProduct);
  if (!sanPhamHienTai) return khongTimThaySanPham();

  var divChiTiet = document.getElementsByClassName("chitietSanpham")[0];

  document.title = nameProduct + " - Bee Mart";

  var h1 = divChiTiet.getElementsByTagName("h1")[0];
  h1.innerHTML += nameProduct;

  var rating = "";
  if (sanPhamHienTai.rateCount > 0) {
    for (var i = 1; i <= 5; i++) {
      if (i <= sanPhamHienTai.star) {
        rating += `<i class="fa fa-star"></i>`;
      } else {
        rating += `<i class="fa fa-star-o"></i>`;
      }
    }
    rating += `<span> ` + sanPhamHienTai.rateCount + ` đánh giá</span>`;
  }
  divChiTiet.getElementsByClassName("rating")[0].innerHTML += rating;

  var price = divChiTiet.getElementsByClassName("area_price")[0];
  if (sanPhamHienTai.promo.name != "giareonline") {
    price.innerHTML = `<strong>` + sanPhamHienTai.price + `₫</strong>`;
    price.innerHTML += new Promo(sanPhamHienTai.promo.name, sanPhamHienTai.promo.value).toWeb();
  } else {
    document.getElementsByClassName("ship")[0].style.display = "";
    price.innerHTML =
      `<strong>` +
      sanPhamHienTai.promo.value +
      `&#8363;</strong>
					        <span>` +
      sanPhamHienTai.price +
      `&#8363;</span>`;
  }

  document.getElementById("detailPromo").innerHTML = getDetailPromo(sanPhamHienTai);

  var info = document.getElementsByClassName("info")[0];
  var s = addThongSo("Mô tả", sanPhamHienTai.detail.desc);
  info.innerHTML = s;

  var hinh = divChiTiet.getElementsByClassName("picture")[0];
  hinh = hinh.getElementsByTagName("img")[0];
  hinh.src = sanPhamHienTai.img;
  document.getElementById("bigimg").src = sanPhamHienTai.img;

  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items: 5,
    center: true,
    smartSpeed: 450,
  });
}

function getDetailPromo(sp) {
  switch (sp.promo.name) {
    case "giamgia":
      var span = `<span style="font-weight: bold">` + sp.promo.value + `</span>`;
      return `Khách hàng sẽ được giảm ` + span + `₫ khi tới mua trực tiếp tại cửa hàng`;
    case "moiramat":
      return `Khách hàng sẽ được thử máy miễn phí tại cửa hàng. Có thể đổi trả lỗi trong vòng 2 tháng.`;
    default:
      break;
  }
}

function addThongSo(ten, giatri) {
  return (
    `<li>
                <p>` +
    ten +
    `</p>
                <div>` +
    giatri +
    `</div>
            </li>`
  );
}

function addSmallImg(img) {
  var newDiv =
    `<div class='item'>
                        <a>
                            <img src=` +
    img +
    ` onclick="changepic(this.src)">
                        </a>
                    </div>`;
  var banner = document.getElementsByClassName("owl-carousel")[0];
  banner.innerHTML += newDiv;
}

function opencertain() {
  document.getElementById("overlaycertainimg").style.transform = "scale(1)";
}

function closecertain() {
  document.getElementById("overlaycertainimg").style.transform = "scale(0)";
}

function changepic(src) {
  document.getElementById("bigimg").src = src;
}

function addKhungSanPham(list_sanpham, tenKhung, color, ele) {
  var gradient =
    `background-image: linear-gradient(120deg, ` +
    color[0] +
    ` 0%, ` +
    color[1] +
    ` 50%, ` +
    color[0] +
    ` 100%);`;
  var borderColor = `border-color: ` + color[0];
  var borderA =
    `	border-left: 2px solid ` +
    color[0] +
    `;
					border-right: 2px solid ` +
    color[0] +
    `;`;

  var s =
    `<div class="khungSanPham" style="` +
    borderColor +
    `">
				<h3 class="tenKhung" style="` +
    gradient +
    `">* ` +
    tenKhung +
    ` *</h3>
				<div class="listSpTrongKhung flexContain">`;

  for (var i = 0; i < list_sanpham.length; i++) {
    s += addProduct(list_sanpham[i], null, true);
  }

  ele.innerHTML += s;
}

function suggestion() {
  const giaSanPhamHienTai = stringToNum(sanPhamHienTai.price);

  const sanPhamTuongTu = list_products
    .filter((_) => _.masp !== sanPhamHienTai.masp)
    .map((sanPham) => {
      const giaSanPham = stringToNum(sanPham.price);
      let giaTienGanGiong = Math.abs(giaSanPham - giaSanPhamHienTai) < 1000000;

      let soLuongChiTietGiongNhau = 0;
      for (let key in sanPham.detail) {
        let value = sanPham.detail[key];
        let currentValue = sanPhamHienTai.detail[key];

        if (value == currentValue) soLuongChiTietGiongNhau++;
      }
      let giongThongSoKyThuat = soLuongChiTietGiongNhau >= 3;

      let cungHangSanXuat = sanPham.company === sanPhamHienTai.company;
      let cungLoaiKhuyenMai = sanPham.promo?.name === sanPhamHienTai.promo?.name;

      let soDanhGia = Number.parseInt(sanPham.rateCount, 10);
      let soSao = Number.parseInt(sanPham.star, 10);

      let diem = 0;
      if (giaTienGanGiong) diem += 20;
      if (giongThongSoKyThuat) diem += soLuongChiTietGiongNhau;
      if (cungHangSanXuat) diem += 15;
      if (cungLoaiKhuyenMai) diem += 10;
      if (soDanhGia > 0) diem += (soDanhGia + "").length;
      diem += soSao;

      return {
        ...sanPham,
        diem: diem,
      };
    })
    .sort((a, b) => b.diem - a.diem)
    .slice(0, 10);

  console.log(sanPhamTuongTu);

  if (sanPhamTuongTu.length) {
    let div = document.getElementById("goiYSanPham");
    addKhungSanPham(sanPhamTuongTu, "Bạn có thể thích", ["#434aa8", "#ec1f1f"], div);
  }
}
