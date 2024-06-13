function xacnhanthanhtoan() {
  currentuser.donhang.push({
    sp: currentuser.products,
    ngaymua: new Date(),
    tinhTrang: "Đã thanh toán",
  });
  currentuser.products = [];
  capNhatMoiThu();
  setTimeout(function () {
    // addAlertBox("Các sản phẩm đã được gửi vào đơn hàng và chờ xử lý.", "#17c671", "#fff", 4000);
    console.log("Testing");
  }, 1000);
}