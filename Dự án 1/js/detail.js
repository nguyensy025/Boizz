var soluong = document.querySelector(".soluong>input").value;

function addCart(e, id, ten, gia, hinh) {
  let cartItems = JSON.parse(localStorage.getItem("cart"));
  if (cartItems == null) cartItems = [];
  var dacosanphamtronggio = false;
  for (i = 0; i < cartItems.length; i++) {
    var sp = cartItems[i];
    if (sp["id"] == id) {
      sp["soluong"]++;
      dacosanphamtronggio = true;
    }
  }
  if (dacosanphamtronggio == false) {
    cartItems.push({ id, ten, gia, hinh, soluong: 1 });
  }
  localStorage.setItem("cart", JSON.stringify(cartItems));
  alert("Thêm vào giỏ hàng thành công");
}
