<?php
include './provider.php';
if (isset($_POST['password'])) {

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $email = $_SESSION['email'];

    // Cập nhật mật khẩu mới
    $sql = "UPDATE userss SET password='$password' WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        $success = "Đổi mật khẩu thành công!";
    } else {
        $error = "Có lỗi xảy ra";
    }
}

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Reset Password</h2>
            <?php
            if (isset($errors) && count($errors) > 0) {
                foreach ($errors as $error) {
                    echo '<div class="alert alert-danger" role="alert">
                        ' . $error . '
                        </div>';
                }
            }
            ?>
            <form action="" method="POST">
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Enter your new password">
                </div>
                <button type="submit" class="btn btn-primary" name="reset_submit">Reset Password</button>
            </form>
        </div>
    </div>
</div>