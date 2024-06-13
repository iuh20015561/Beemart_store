function xacnhanthanhtoan() {
  currentuser.donhang.push({
    sp: currentuser.products,
    ngaymua: new Date(),
    tinhTrang: "Đã thanh toán",
  });
  currentuser.products = [];
  capNhatMoiThu();
}
