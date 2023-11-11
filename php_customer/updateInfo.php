<?php include('../includes/header.html'); ?>

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
    .update-form {
        width: fit-content;
        margin: 0 auto;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        border-radius: 5%;
    }
    .update-form h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 1rem;
        color: #333;
    }
    .update-form input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 0.7rem;
        border: 1px solid #ccc;
    }
    #goback {
        text-decoration: none;
        color: blue;
        opacity: 0.7;
    }
    #goback:hover {
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

    $thongbao = '';
    if (isset($_POST['hoTen']))
        $hoTen = trim($_POST['hoTen']);
    else $hoTen = '';
    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = '';
    if (isset($_POST['sdt']))
        $sdt = trim($_POST['sdt']);
    else $sdt = '';

    require("connect.php");

    $user = $_SESSION['user'];
    $maND = $user['id'];

    if (isset($_POST['update'])) {

        $newName = $_POST['hoTen'] ?? null;
        $newSdt = $_POST['sdt'] ?? null;
        $newDiaChi = $_POST['diaChi'] ?? null;

        $updateQuery = "UPDATE nguoidung SET";
        $updates = array();

        if (!empty($newName)) {
            $updates[] = "hoTen = '$newName'";
        }

        if (!empty($newSdt)) {
            $updates[] = "sdt = '$newSdt'";
        }

        if (!empty($newDiaChi)) {
            $updates[] = "diaChi = '$newDiaChi'";
        }

        if (!empty($updates)) {
            $updateQuery .= " " . implode(", ", $updates);
            $updateQuery .= " WHERE maND = '$maND'";

            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                $thongbao = "<p align=center><font color=green>Cập nhật thông tin thành công</font></p>";
            } else {
                $thongbao = "<p align=center><font color=red>Cập nhật thông tin không thành công</font></p>";
            }
        }
    }

    $query = "SELECT hoTen, sdt, diaChi FROM nguoidung WHERE maND = '$maND'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        $hoTen = $userData['hoTen'];
        $sdt = $userData['sdt'];
        $diaChi = $userData['diaChi'];
    } else {
        $thongbao = "<p align=center><font color=red>Không tìm thấy thông tin</font></p>";
    }
?>
<main>

<main>
    <form action="" method="post">
        <div class='update-form'>
            <h2>Thay đổi thông tin cá nhân</h2>
            <?php echo $thongbao; ?>
            <table>
                <tr>
                    <td>Họ tên:</td>
                    <td><input type="text" size=40 name="hoTen" required value="<?php echo $hoTen; ?>"/></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td><input type="text" size=40 name="diaChi" required value="<?php echo $diaChi; ?>"/></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td><input type="text" size=20 name="sdt" required value="<?php echo $sdt; ?>"/></td>
                </tr>
                <tr>
                    <td colspan=2 align=center id='submitRow'>
                        <input type='submit' value='Cập nhật' name='update' id='btnUpdate'/>
                    </td>
                </tr>
            </table>
            <p align=center><a id="goback" href="./profile.php">Quay lại</a></p>
        </div>
    </form>
</main>
<?php include('../includes/footer.php'); ?>