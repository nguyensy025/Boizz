<?php
function getCategoryNameById($categoryId) {
    global $connection; // Đảm bảo biến $connection là biến kết nối đến CSDL
    
    // Chuẩn bị câu truy vấn
    $sql = "SELECT name FROM categories WHERE id = :category_id";
    $stm = $connection->prepare($sql);
    
    // Thực thi truy vấn và lấy kết quả
    $stm->execute([':category_id' => $categoryId]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    // Trả về tên của category hoặc trả về một giá trị mặc định nếu không tìm thấy
    return $result ? $result['name'] : 'Unknown Category';
}
?>