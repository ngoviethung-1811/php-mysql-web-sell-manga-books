<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
    table {
        border-collapse:collapse;
    }
    td {
        padding: 0.5rem;
    }
    #submitRow input[type=submit] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    #submitRow input[type=submit]:hover{
        background-color: #0056b3;
    }
    .register-form {
        width: fit-content;
        margin: 0 auto;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        border-radius: 5%;
    }
    .register-form h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 1rem;
        color: #333;
    }
    .register-form input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 0.7rem;
        border: 1px solid #ccc;
    }
</style>

<?php
    if (isset($_POST['hoTen']))
        $hoTen = trim($_POST['hoTen']);
    else $hoTen = '';
    if (isset($_POST['email']))
        $email = trim($_POST['email']);
    else $email = '';
    if (isset($_POST['password']))
        $password = trim($_POST['password']);
    else $password = '';
    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = '';
    if (isset($_POST['sdt']))
        $sdt = trim($_POST['sdt']);
    else $sdt = '';

    $thongbao = '';

    if (isset($_POST['register'])) {
    
        require("connect.php");

        $hoTen = isset($_POST['hoTen']) ? mysqli_real_escape_string($conn, trim($_POST['hoTen'])) : '';
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, trim($_POST['password'])) : '';
        $diaChi = isset($_POST['diaChi']) ? mysqli_real_escape_string($conn, trim($_POST['diaChi'])) : '';
        $sdt = isset($_POST['sdt']) ? mysqli_real_escape_string($conn, trim($_POST['sdt'])) : '';

        if (empty($hoTen) || empty($email) || empty($password) || empty($diaChi) || empty($sdt)) {
            $thongbao = "<p align=center><font color=red>Vui lòng điền đầy đủ thông tin!</font></p>";
        } else {

            $check_query = "SELECT COUNT(*) AS email_count FROM nguoidung WHERE email = '$email'";
            $check_result = mysqli_query($conn, $check_query);
            $check_row = mysqli_fetch_assoc($check_result);
            $email_count = $check_row['email_count'];

            if ($email_count > 0) {
                $thongbao = "<p align=center><font color=red>Email đã được đăng ký! Vui lòng chọn email khác</font></p>";
            } else {
                $query = "SELECT MAX(maND) AS max_maND FROM nguoidung";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $max_maND = $row['max_maND'];

                $numericPart = intval(substr($max_maND, 2)) + 1;

                $new_maND = 'nd' . str_pad($numericPart, 5, '0', STR_PAD_LEFT);

                $maVT = 'vt003';

                $sql = "INSERT INTO nguoidung (maVT, maND, hoTen, email, password, diaChi, sdt) 
                        VALUES ('$maVT', '$new_maND', '$hoTen', '$email', '$password', '$diaChi', '$sdt')";

                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Đăng ký thành công");</script>';
                    echo '<script>window.location.href = "login.php";</script>';
                    exit();
                } else {
                    $thongbao = "<p align=center><font color=red>Đăng ký không thành công! Vui lòng thử lại.</font></p>";
                }
            }
        }

        mysqli_close($conn);
    }
?>

<main>
    <form action="" method="post">
        <div class='register-form'>
            <h2>Đăng ký</h2>
            <?php echo $thongbao; ?>
            <table>
                <tr>
                    <td>Nhập họ tên:</td>
                    <td><input type="text" size=40 name="hoTen" required value="<?php echo $hoTen; ?>"/></td>
                </tr>
                <tr>
                    <td>Nhập email:</td>
                    <td><input type="email" size=40 name="email" required value="<?php echo $email; ?>"/></td>
                </tr>
                <tr>
                    <td>Nhập mật khẩu:</td>
                    <td><input type="password" size=40 name="password" required value="<?php echo $password; ?>"/></td>
                </tr>
                <tr>
                    <td>Nhập địa chỉ:</td>
                    <td><input type="text" size=40 name="diaChi" required value="<?php echo $diaChi; ?>"/></td>
                </tr>
                <tr>
                    <td>Nhập số điện thoại:</td>
                    <td><input type="text" size=20 name="sdt" required value="<?php echo $sdt; ?>"/></td>
                </tr>
                <tr>
                    <td colspan=2 align=center id='submitRow'>
                        <input type='submit' value='Đăng ký' name='register' id='btnRegister'/>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</main>

<?php
include('../includes/footer.php');
?>