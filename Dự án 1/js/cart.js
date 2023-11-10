let cartItems = JSON.parse(localStorage.getItem("cart"));
if (cartItems == null) cartItems = [];

var arrsp = [  {    hinh: "image/1.png",    ten: "Thức ăn cho mèo",    soluong: 1,    gia: 100000,  },  {    hinh: "image/1.png",    ten: "Thức ăn cho chó",    soluong: 2,    gia: 100000,  },  {    hinh: "image/0.png",    ten: "Thức ăn cho chó",    soluong: 4,    gia: 100000,  }, {    hinh: "image/thucan1.jpg",    ten: "Thức ăn cho mèo",    soluong: 1,    gia: 100000,  },
        {    hinh: "image/thucan2.jpg",    ten: "Soup lon vị gà cho mèo trưởng thành",    soluong: 1,    gia: 50000,  }, {    hinh: "image/thucan3.jpg",    ten: "Hạt vị cá thu",    soluong: 1,    gia: 150000,  }, {    hinh: "image/thucan4.jpg",    ten: "Hạt vị tổng hợp",    soluong: 1,    gia: 150000,  }];

function napsp() {
  var tbody = document.getElementById("datadrow");
  tbody.innerText = "";
  for (var i = 0; i < cartItems.length; i++) {
    var tr = document.createElement("tr");
    tbody.appendChild(tr);
    var sp = cartItems[i];
    tr.innerHTML = `<td id="hinh"><img src="${sp.hinh}" alt=""> </td>
      <td id="ten">${sp.ten}</td>
      <td id="soluong">
          <input type="number" value="${sp.soluong}"
          onchange="suasoluong(${i},this.value)"
          min="1"
          />
          </td>
      <td id="gia">${sp.gia.toLocaleString()}</td> 
      <td id="tong">${(sp.soluong * sp.gia).toLocaleString()}</td>
      <td id="xoa" onclick="xoa(${i})"><button>Xóa</button></td>
    `;
  }
  tinhtongtien();
  localStorage.setItem("cart", JSON.stringify(cartItems));
}

function suasoluong(index, sl) {
  cartItems[index].soluong = sl;
  napsp();
}

function xoa(index) {
  cartItems.splice(index, 1);
  napsp();
}

function themvaogiohang(index) {
  var sp = arrsp[index];
  var indexInCart = -1;
  for (var i = 0; i < cartItems.length; i++) {
    if (cartItems[i].ten === sp.ten) {
      indexInCart = i;
      break;
    }
  }
  if (indexInCart === -1) {
    sp.soluong = 1;
    cartItems.push(sp);
  } else {
    cartItems[indexInCart].soluong++;
  }
  napsp();
}

function tinhtongtien() {
  var tongtien = 0;
  for (var i = 0; i < cartItems.length; i++) {
    var sp = cartItems[i];
    tongtien += sp.soluong * sp.gia;
  }
  document.getElementById("tongtien").innerHTML = tongtien.toLocaleString();
}

napsp();
