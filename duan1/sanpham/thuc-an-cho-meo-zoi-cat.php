<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LittleCat</title>
  <link rel="stylesheet" href="../css/thongtin.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="../css/sanpham.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  
</head>
<body>
  <div class="head">
    <a href="../index.html">
      <div class="logo">
          <img width="90px" src="../image/Cute Cat Grooming Logo.png" alt="">
      </a>
          <h2> LittleCat </h2>
    <div class="top-right">
      <a href="../dangnhap.html"><i class='bx bx-user'></i></a>
      <a href="../cart.html"><i class='bx bx-cart'></i></a>
    </div>
  </div>

  <nav>

    <div class="menu">
      <li><a href="../index.html">Trang Chủ </a></li>
      <li><a href="#">Liên Hệ</a></li>
      <li><a href="#">Sản Phẩm</a>

        <ul class="menucon">
          <li>Thức Ăn Cho Mèo</li>
          <li>Phụ Kiện Cho Mèo</li>
          <li>Thông Tin Các Giống Mèo</li>
          <li>Thời Trang Mèo</li>
        </ul>
      </li>
      <li><a href="../blog.html">Blog</a></li>
      <div class="search">
        <input type="text" placeholder="Bạn muốn tìm gì ?"><a class="tk" href=""><i class='bx bx-search'></i></a>
      </div>
    </div>

  </nav>

  <article>
    <div class="khung">
      <div class="hinh">
        <img src="../image/1.png" alt="anhsp">
      </div>
      <br>
    </div>
    <div class="thongtin">
      <h3>Thức ăn cho mèo Zoi Cat </h3>
      <span> Giá: 150.000 vnđ</span> <br>
      <span>Lượt Xem : 199</span> <i class="ri-eye-line"></i>
      <br>
      <!-- <input type="button" value="Thêm Vào Giỏ Hàng" onclick="addCart(this, 3, 'Thức ăn cho mèo Zoi Cat', 150000, 'image/1.png', 1)">
      <input type="button" value="Mua Ngay"> -->
      <form method="post" action="">
        Nhập số lượng: <input type="number" name="so_luong" min="1"><br>
        <input type="submit" value="Thêm vào giỏ hàng">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $so_luong = $_POST['so_luong'];
    
        if ($so_luong < 1) {
            echo "Vui lòng nhập số lượng lớn hơn hoặc bằng 1.";
        } else {
          echo "Đã thêm vào giỏ hàng thành công!";
        }
    }
    ?>

  <div id="popup" class="popup">
    Đã thêm vào giỏ hàng thành công
</div>

      
      
      <br>
      <!-- <div class="soluong">
        <input id="inputNumber" type="text" placeholder="Số Lượng" pattern="[1-9][0-9]*" oninput="validateInput()" required>
        <p id="errorMessage" style="display: none; color: red;">Số không hợp lệ, vui lòng nhập số dương.</p>
      </div> -->
     
    
    
 


  </article>

  
  <aside>
    <h3>Thông Tin Sản Phẩm</h3>
    <div class="uudiem">
      <h4>1. Ưu điểm sản phẩm</h4>
      Thức ăn cho mèo Zoi_Cat được chế biến đặc biệt dành cho mèo ở mọi độ tuổi giúp cải thiện da lông, tăng cường
      tiêu hóa. Sản phẩm sử dụng nguyên liệu chọn lọc giàu dinh dưỡng, dễ dàng tiêu hóa mang đến hương vị thơm
      ngon nhất đồng thời giúp cải thiện hệ miễn dịch, kích thích hoạt tính sinh học, nâng cao khả năng hấp thụ
      dinh dưỡng, tăng cường sức khỏe đường ruột và giảm lượng đào thải.
      <br>
      – Cải thiện thị lực, cho đôi mắt khỏe mạnh : Thành phần Taurin và vitamin A giúp mắt mèo sáng khỏe và cải
      thiện thị lực.
      <br>
      – Cải thiện hệ miễn dịch : Hàm lượng đạm cao cấp và chất chống oxy hóa cân bằng giúp cải thiện hệ miễn dịch
      của mèo.
      <br>
      – Hệ tiêu hóa khỏe mạnh : Sản phẩm được chế biến đặc biệt để tăng cường khả năng tiêu hóa giúp mèo hấp thụ
      dinh dưỡng tối ưu và giảm tối thiểu lượng đào thải.
      <br>
      – Da lông khỏe mạnh mềm mượt : Thành phần dầu oliu , hàm lượng axit béo Omega 3 cân bằng từ thịt cá, vitamin
      A và hàm lượng đạm cao cấp giúp mèo có một làn da khỏe mạnh và bộ lông mềm mượt.
    </div>
    <div class="thanhphan">
      <h4>2. Thành Phần</h4>
      <li>Độ đạm (min) 30%</li>
      <li>Độ béo(min) 9%</li>
      <li>Chất xơ (max) 4%</li>
      <li>Độ ẩm (max) 10%</li>
      <li>Năng lượng trao đổi ( min ) 3000 Kcal</li>
      <li>Canxi ( min – max ) 0.5 – 3%</li>
      <li>Phốt pho ( min – max ) 0.5 – 2%</li>
      <li>Lysine ( min ) 0.9%</li>
      <li>Methione ( min ) 0.5%</li>
      <li>Tro ( max ) 5%</li>
      <li>Cát ( max ) 2%</li>
      <li>Kháng sinh Không</li>
    </div>

    <div class="nguyenlieu">
      <h4>3. Nguyên Liệu </h4>
      Bắp ,bột thịt gia cầm, bã nành, hạt lúa mì, gấc, dầu olive, quả noni, nấm linh chi, tấm gạo, mỡ gia cầm ,
      bột Cá , Gluten lúa mì, bột xương thịt, cám mì. khoáng chất (Sắt ,Đồng,Man-gan,Kẽm ,I-ốt,Sê-Ien),Vitamin
      (A,D3,E,K3,B1,B2,B6,B12,PP,D Calcium Pantothenate, Biontin, Axit Folit, Choline), DCP, bột canxi, muối, axit
      amin, chất chống nấm mốc, Chất chống Oxy hoá, Dầu cá (có chứa DHA), taurin, phẩm màu, chất hấp dẫn.
    </div>

    <div class="huongdan">
      <h4>4. Hướng dẫn sử dụng</h4>
      Để tránh tình trạng khó tiêu với những thay đổi đột ngột, hãy thay thế từ từ lượng thức ăn cũ bằng thức ăn
      mèo Pro-Cat cho đến khi tất cả thức ăn cũ được thay thế hoàn toàn trong 1 tuần.
      <br>
      Cho ăn 2 lần mỗi ngày.
      <br>
      Hãy để nước sạch luôn có sẵn cho mèo mọi lúc.
    </div>
    <div class="baoquan">
      <h4>5. Bảo quản</h4>
      - Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp
      <br>
      - Nên đóng kín miệng bao sau khi cho ăn để bảo quản tốt nhất.
    </div>

  </aside>


  <footer>
    <div class="tuvan">
      <h1>Tư Vấn Mua Hàng Cùng LittleCat</h1>
      <input type="text" placeholder="Họ và tên ...">
      <input type="text" placeholder="Số điện thoại ...">

      <button>Gửi Liên Hệ</button>
    </div>
    <div class="end">


      <div class="about">
        <h3>HỖ TRỢ KHÁCH HÀNG</h3>
        <br>
        <li>Hoạt động từ 8h – 21h hàng ngày: 09********</li>
        <li>Hỗ trợ đơn hàng online: 8h – 17h, Thứ Hai đến Thứ Bảy: 09********</li>
        <li>Phương thức thanh toán</li>
        <li>Phương thức giao hàng</li>
        <li>Hướng dẫn đổi trả hàng</li>
        <li>Hướng dẫn mua hàng</li>
        <li>Câu hỏi thường gặp</li>
        <li>Chính sách hàng nhập khẩu</li>

      </div>
      <div class="thongtinbanquyen">
        <h3>VỀ LITTLECAT</h3>
        <br>
        <li>Liên hệ</li>
        <li>Tuyển dụng</li>
        <li>Mua phụ kiện cho thú cưng</li>
        <li>Blog Boss và Sen</li>
        <li>Blog Thú cưng</li>
        <li>Cát vệ sinh cho mèo</li>
        <li>Đồ chơi cho mèo</li>

      </div>
      <div class="hotro">
        <h3>HỢP TÁC VÀ LIÊN KẾT</h3>
        <br>
        <li>Quy chế hoạt động của LittleCat</li>
        <li>Bán hàng cùng LittleCat</li>
        <img src="../image/Cute Cat Grooming Logo.png" alt="">

      </div>
    </div>

    <div class="banquyen">
      <a href="/">Bản quyền © 2023 CÔNG TY TNHH LITTLECAT VIỆT NAM – Giấy phép ĐKKD số 0XXXXXX</a>
    </div>
  </footer>

  <script src="../js/detail.js"></script>
</body>

</html>
