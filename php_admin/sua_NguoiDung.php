<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<?php
    if ($_SESSION['user']['role']!='admin'){
        header('Location: ../html/permission_denied.html');
        exit();
    }
?>

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $mand = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat']))
        {
            $hoTen = trim($_POST['tennd']);
            $maVT = trim($_POST['vaitro']);
            $sdt = trim($_POST['sdt']);
            $email = trim($_POST['email']);
            $diaChi = trim($_POST['diachi']);
            $password = trim($_POST['password']);

            $sql = "UPDATE nguoidung SET hoTen = '$hoTen', 
                                    maVT = '$maVT', 
                                    sdt = '$sdt', 
                                    email = '$email', 
                                    diaChi = '$diaChi', 
                                    password = '$password'
                    WHERE maND = '$mand'";
            $result = mysqli_query($conn, $sql);
            if ($result)
            {
                $tennd=$hoTen;
                $mavaitro= $maVT;
                $Email= $email;
                $Diachi= $diaChi;
                $Sdt= $sdt;
                $Password= $password;
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM nguoidung 
                WHERE maND = '$mand'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tennd=$row['hoTen'];
            $mavaitro= $row['maVT'];
            $Email= $row['email'];
            $Diachi= $row['diaChi'];
            $Sdt= $row['sdt'];
            $Password= $row['password'];
        }
        else {
            $tennd='';
            $mavaitro='';
            $Email='';
            $Diachi='';
            $Sdt='';
            $Password='';
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA NGƯỜI DÙNG</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã người dùng:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="mand" value="<?php echo $mand; ?>"/></td>
            </tr>
            <tr>
                <td>Tên người dùng:</td>
                <td><input type="text" size=40 name="tennd" value="<?php echo $tennd; ?>"/></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" size=40 name="email" value="<?php echo $Email; ?>" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" size=40 name="password" value="<?php echo $Password; ?>"/></td>
            </tr>
            <tr>
                <td>Vai trò:</td>
                <td>
                    <select name="vaitro" >
                        <?php
                            $query = "SELECT maVT,tenVT FROM vaitro";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                if($mavaitro == $row['maVT'])
                                    echo '<option selected value="' . $row['maVT'] . '">' . $row['tenVT'] . '</option>';
                                else
                                    echo '<option value="' . $row['maVT'] . '">' . $row['tenVT'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" size=40 name="diachi" value="<?php echo $Diachi; ?>"/></textarea></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" size=20 name="sdt" value="<?php echo $Sdt; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
                </td>
            </tr>	
        </table>
        <p align=center><a id="goback" href="./hienthi_NguoiDung.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_NguoiDung');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>