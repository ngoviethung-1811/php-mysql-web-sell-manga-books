<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    if ($_SESSION['user']['role']!='admin'){
        header('Location: ../html/permission_denied.html');
        exit();
    }
?>

<?php
    require("connect.php");

    function xoaNguoiDung($maND) {
        global $conn;

        $query = "DELETE FROM nguoidung WHERE maND = '$maND'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maND = $_GET['id'];
        if (isset($_POST['tenND']))
            $tenND = trim($_POST['tenND']);
        else $tenND = '';
        if (isset($_POST['vaiTro']))
            $vaiTro = trim($_POST['vaiTro']);
        else $vaiTro = '';
        if (isset($_POST['email']))
            $email = trim($_POST['email']);
        else $email = '';
        if (isset($_POST['diaChi']))
            $diaChi = trim($_POST['diaChi']);
        else $diaChi = '';
        if (isset($_POST['sdt']))
            $sdt = trim($_POST['sdt']);
        else $sdt = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaNguoiDung($maND);
            
            if ($kqXoa) {
                $maND = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT nguoidung.*,vaitro.tenVT as vaitro  
            FROM nguoidung 
            INNER JOIN vaitro ON nguoidung.maVT = vaitro.maVT 
            WHERE maND = '$maND'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)<>0) {
            while($rows=mysqli_fetch_assoc($result)) {
                $tenND = $rows['hoTen'];
                $vaiTro = $rows['vaitro'];
                $email = $rows['email'];
                $diaChi = $rows['diaChi'];
                $sdt = $rows['sdt'];
            }
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ NGƯỜI DÙNG</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã người dùng:</td>
                <td><input type="text" disabled size=20 name='maND' value='<?php echo $maND ?>'></td>
            </tr>
            <tr>
                <td>Tên người dùng:</td>
                <td><input type="text" disabled size=40 name='tenND' value='<?php echo $tenND ?>'></td>
            </tr>
            <tr>
                <td>Vai trò:</td>
                <td><input type="text" disabled size=20 name='vaiTro' value='<?php echo $vaiTro ?>'></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" disabled size=40 name='email' value='<?php echo $email ?>'></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" disabled size=40 name='diaChi' value='<?php echo $diaChi ?>'></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" disabled size=20 name='sdt' value='<?php echo $sdt ?>'></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
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