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
  
  // Hiển thị popup một cách gradual
  var popup = document.getElementById("popup");
  popup.style.display = "block";
  popup.style.opacity = 0; // Đặt opacity ban đầu là 0

  // Sử dụng setTimeout để tăng dần opacity lên 1
  var opacity = 0;
  var interval = 1; // Thời gian cách nhau giữa các bước tăng opacity
  var increment = 0.02; // Bước tăng opacity

  var fadeInInterval = setInterval(function() {
    if (opacity >= 1) {
      clearInterval(fadeInInterval);
    } else {
      opacity += increment;
      popup.style.opacity = opacity;
    }
  }, interval);

  // Ẩn popup sau một khoảng thời gian (ví dụ: 1 giây)
  setTimeout(function() {
    // Sử dụng cùng một cách để giảm opacity xuống 0
    var fadeOutInterval = setInterval(function() {
      if (opacity <= 0) {
        popup.style.display = "none";
        clearInterval(fadeOutInterval);
      } else {
        opacity -= increment;
        popup.style.opacity = opacity;
      }
    }, interval);
  }, 1000);
}




// function addCart(button, productId, productName, productPrice, productImage, quantity) {
//   // Xử lý thêm sản phẩm vào giỏ hàng

//   // Hiển thị popup một cách gradual
//   var popup = document.getElementById("popup");
//   popup.style.display = "block";
//   popup.style.opacity = 0; // Đặt opacity ban đầu là 0

//   // Sử dụng setTimeout để tăng dần opacity lên 1
//   var opacity = 0;
//   var interval = 1; // Thời gian cách nhau giữa các bước tăng opacity
//   var increment = 0.02; // Bước tăng opacity

//   var fadeInInterval = setInterval(function() {
//     if (opacity >= 1) {
//       clearInterval(fadeInInterval);
//     } else {
//       opacity += increment;
//       popup.style.opacity = opacity;
//     }
//   }, interval);

//   // Ẩn popup sau một khoảng thời gian (ví dụ: 1 giây)
//   setTimeout(function() {
//     // Sử dụng cùng một cách để giảm opacity xuống 0
//     var fadeOutInterval = setInterval(function() {
//       if (opacity <= 0) {
//         popup.style.display = "none";
//         clearInterval(fadeOutInterval);
//       } else {
//         opacity -= increment;
//         popup.style.opacity = opacity;
//       }
//     }, interval);
//   }, 1000);
// }






function addToCart(productId, productName, productPrice) {
  // Tạo một hàng mới trong hóa đơn
  var newRow = document.createElement("tr");

  // Tên sản phẩm
  var productNameCell = document.createElement("td");
  productNameCell.textContent = productName;
  newRow.appendChild(productNameCell);

  // Tổng cộng
  var productPriceCell = document.createElement("td");
  productPriceCell.textContent = productPrice + " vnđ";
  newRow.appendChild(productPriceCell);

  // Thêm hàng vào bảng hóa đơn
  var hoaDonTable = document.getElementById("hoa-don-table");
  var tbody = hoaDonTable.getElementsByTagName('tbody')[0];
  tbody.appendChild(newRow);
}

function validateInput() {
  var input = document.getElementById('inputNumber');
  var errorMessage = document.getElementById('errorMessage');

  if (!/^\d+$/.test(input.value) || parseInt(input.value) < 1) {
    errorMessage.style.display = 'block';
  } else {
    errorMessage.style.display = 'none';
  }
}

