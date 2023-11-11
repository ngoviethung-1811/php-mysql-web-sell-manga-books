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
    if (isset($_POST['current_password']))
        $currentPassword = trim($_POST['current_password']);
    else $currentPassword = '';
    if (isset($_POST['new_password']))
        $newPassword = trim($_POST['new_password']);
    else $newPassword = '';

    if (isset($_POST['update'])) {
        require("connect.php");

        $maND = $_SESSION['user']['id'];

        $currentPassword = trim($_POST['current_password']) ?? null;
        $newPassword = trim($_POST['new_password']) ?? null;

        if ($currentPassword==null || $currentPassword==='' ||
            $newPassword==null || $newPassword==='') {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ thông tin!</font></p>";
        }
        else {
            $checkPasswordQuery = "SELECT maND FROM nguoidung WHERE maND = '$maND' AND password = '$currentPassword'";
            $checkResult = mysqli_query($conn, $checkPasswordQuery);

            if (mysqli_num_rows($checkResult) == 1) {
                $updatePasswordQuery = "UPDATE nguoidung SET password = '$newPassword' WHERE maND = '$maND'";
                $updateResult = mysqli_query($conn, $updatePasswordQuery);

                if ($updateResult) {
                    $thongbao = "<p align=center><font color=green>Đổi mật khẩu thành công</font></p>";
                } else {
                    $thongbao = "<p align=center><font color=red>Có lỗi xảy ra! Vui lòng thử lại sau</font></p>";
                }
            } else {
                $thongbao = "<p align=center><font color=red>Mật khẩu không chính xác! Vui lòng thử lại</font></p>";
            }
        }
    }
?>
<main>
    <form action="" method="post">
        <div class='update-form'>
            <h2>Đổi mật khẩu</h2>
            <?php echo $thongbao; ?>
            <table>
                <tr>
                    <td>Mật khẩu hiện tại:</td>
                    <td><input type="password" size=40 name="current_password" required value="<?php echo $currentPassword; ?>"/></td>
                </tr>
                <tr>
                    <td>Mật khẩu mới:</td>
                    <td><input type="password" size=40 name="new_password" required value="<?php echo $newPassword; ?>"/></td>
                </tr>
                <tr>
                    <td colspan=2 align=center id='submitRow'>
                        <input type='submit' value='Đổi mật khẩu' name='update' id='btnUpdate'/>
                    </td>
                </tr>
            </table>
            <p align=center><a id="goback" href="./profile.php">Quay lại</a></p>
        </div>
    </form>
</main>
<?php include('../includes/footer.php'); ?>