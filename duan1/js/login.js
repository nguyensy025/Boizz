"use strict"
//khai báo lớp để lưu thông tin tài khoản
class Account{
    constructor(userN,email,pass){
        this.userName = userN;
        this.email = email;
        this.password = pass;
    }
}

function xuLyDangKy(event){
    event.preventDefault();
    //lấy thông tin người dùng nhập
    let userName = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    //kiểm tra hợp lệ
    if(userName.trim() === ""){
        alert("Chưa nhập tên đăng nhập")
        return;
    }
    
    //Lưu thông tin tài khoản với key "user"
    let dsTaiKhoan = JSON.parse(localStorage.getItem("user")) 
    //Trường hợp key "user" chưa tồn tại, dsTaiKhoan = null
    if(!dsTaiKhoan){
        //tạo tài khoản mới
        let userMoi = new Account(userName,email,password)
        dsTaiKhoan = []
        //lưu đối tượng vào mảng
        dsTaiKhoan.push(userMoi)
        //Lưu mảng dsTaiKhoan vào localStorage
        localStorage.setItem("user",JSON.stringify(dsTaiKhoan))
        alert("Đăng ký tài khoản thành công")
    }
    //trường hợp đã tồn tại tài khoản
    else{
        //kiểm tra xem username có tồn tại chưa
        const found = dsTaiKhoan.find((user) => user.userName === userName); // for(let user of dsTaiKhoan){user.username === username}
        if(found){
            alert("Tài khoản đã tồn tại")
            return; // ngắt lệnh 
        }
    }
    // trường hợp không trùng thì tạo tài khoản mới cho người ta
    let userMoi = new Account(userName,email,password)
    //lưu thêm vào mảng 
    dsTaiKhoan.push(userMoi)
    //lưu mảng mới vào Localstorage 
    localStorage.setItem("user",JSON.stringify(dsTaiKhoan))
    alert('Đăng ký tài khoản thành công')
}

function xuLyDangNhap(event) {
    event.preventDefault();

    // Lấy giá trị nhập từ người dùng
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Lưu thông tin đăng nhập vào Local Storage (hoặc các phương thức lưu trữ khác)
    localStorage.setItem("username", username);
    localStorage.setItem("password", password);

    // Điều hướng đến trang hồ sơ của tôi
    window.location.href = "profile.html";
}

// Kiểm tra nếu đã đăng nhập và điều hướng đến trang hồ sơ của tôi nếu đã đăng nhập
window.addEventListener("DOMContentLoaded", function () {
    const username = localStorage.getItem("username");
    
    if (username) {
        window.location.href = "profile.html";
    }
});
