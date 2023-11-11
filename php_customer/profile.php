<?php 
include('../includes/header.html');
?>

<style> 
    main {
        padding: 1rem;
    }
    table {
        border-collapse:collapse;
        margin: 1rem;
    }
    td {
        padding: 0.5rem;
    }
    .info-form {
        width: fit-content;
        margin: 0 auto;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        border-radius: 5%;
    }
    .info-form h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 1rem;
        color: #333;
    }
    .linkChucNang {
        text-decoration: none;
        color: blue;
        opacity: 0.7;
    }
    .linkChucNang:hover {
        opacity: 1;
    }
    p {
        margin: 0.5rem;
    }
</style>

<?php  
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }

    $thongbao='';

    $user = $_SESSION['user'];

    require("connect.php");

    $maND = $user['id'];

    $query = "SELECT hoTen, email, sdt, diaChi FROM nguoidung WHERE maND = '$maND'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        $hoTen = $userData['hoTen'];
        $sdt = $userData['sdt'];
        $diaChi = $userData['diaChi'];
        $email = $userData['email'];
    } else {
        $thongbao = "<p align=center><font color=red>Không tìm thấy thông tin</font></p>";
    }
?>
<main>
    <div class='info-form'>
        <h2>Thông tin cá nhân</h2>
        <table>
            <tr>
                <td colspan=2><?php echo $thongbao; ?></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><?php echo $hoTen ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><?php echo $diaChi ?></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><?php echo $sdt ?></td>
            </tr>
        </table>
        <p align=center><a class='linkChucNang' href="updateInfo.php">Thay đổi thông tin cá nhân</a></p>
        <p align=center><a class='linkChucNang' href="updatePassword.php">Thay đổi mật khẩu</a></p>
        <p align=center><a class='linkChucNang' href="thongke_GiaoDich.php">Xem lịch sử giao dịch</a></p>
    </div>
</main>
<?php include('../includes/footer.php'); ?>