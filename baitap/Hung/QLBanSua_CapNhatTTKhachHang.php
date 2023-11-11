<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<?php

require("QLBanSua_connect.php");

function capNhatKH($maKH, $tenKH, $gioiTinh, $diaChi, $dienThoai, $email) {
    global $conn;

    if ($gioiTinh === 'nam') $phai = 0;
    else $phai = 1;

    $result = mysqli_query($conn, "UPDATE khach_hang SET
        Ten_khach_hang = '$tenKH', Phai=$phai, Dia_chi = '$diaChi', Dien_thoai = '$dienThoai', Email = '$email'
        WHERE Ma_khach_hang = '$maKH'");

    return $result;
}

if (isset($_GET['ma_kh'])) {
    $displayContent = "";
    $displayNotFound = "display: none";

    $maKH = $_GET['ma_kh'];
    if (isset($_POST['tenKH']))
        $tenKH = trim($_POST['tenKH']);
    else $tenKH = '';
    if (isset($_POST['radGT']))
        $gioiTinh = trim($_POST['radGT']);
    else $gioiTinh = '';
    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = '';
    if (isset($_POST['dienThoai']))
        $dienThoai = trim($_POST['dienThoai']);
    else $dienThoai = '';
    if (isset($_POST['email']))
        $email = trim($_POST['email']);
    else $email = '';

    if (isset($_POST['capnhat'])) {
        $kqCapNhat = capNhatKH($maKH, $tenKH, $gioiTinh, $diaChi, $dienThoai, $email);
        
        if ($kqCapNhat) echo "<font color=green>Cập nhật khách hàng thành công!</font><br>";
        else echo "<font color=red>Cập nhật khách hàng không thành công!</font><br>";
    }

    $result = mysqli_query($conn, "SELECT * FROM khach_hang 
        WHERE Ma_khach_hang='$maKH'");
    
    if(mysqli_num_rows($result)<>0) {
        while($rows=mysqli_fetch_assoc($result)) {
            $tenKH = $rows['Ten_khach_hang'];
            if ($rows['Phai'] == false) {
                $gioiTinh = 'nam';
                $_POST['radGT'] = 'nam';
            }
            else {
                $gioiTinh = 'nu';
                $_POST['radGT'] = 'nu';
            }
            $diaChi = $rows['Dia_chi'];
            $dienThoai = $rows['Dien_thoai'];
            $email = $rows['Email'];
        }
    }
}
else {
    $displayNotFound = "";
    $displayContent = "display: none";
}
?>

<style>
    #ttKH {            
        <?php echo $displayContent; ?>
    }
    #notFound {            
        <?php echo $displayNotFound; ?>
    }
    table {
        background: #f7e8bc;
    }
    td {
        padding: 0.5rem;
    }
    th {
        font-size: 2rem;
        background: #f7da39;
        color: #fc2605;
    }
    #submitRow {
        background: #cfc380;
    }
</style>
<form action="" method="post">
    <div align='center' id='ttKH'>
        <table>
            <tr>
                <th colspan=2>CẬP NHẬT THÔNG TIN KHÁCH HÀNG</th>
            </tr>
            <tr>
                <td>Mã khách hàng:</td>
                <td><input type="text" disabled style='background:#ffe761;' name='maKH' value='<?php echo $maKH ?>'></td>
            </tr>
            <tr>
                <td>Tên khách hàng:</td>
                <td><input type="text" name="tenKH" size=40 value="<?php echo $tenKH; ?>"></td>
            </tr>
            <tr>
                <td>Phái:</td>
                <td>
                    <input type="radio" name="radGT" value="nam"<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nam') echo 'checked="checked"';?> checked/> Nam 
                    <input type="radio" name="radGT" value="nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nu') echo 'checked="checked"';?>/>
                            Nữ<br>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" name="diaChi" size=40 value="<?php echo $diaChi; ?>"></td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><input type="text" name="dienThoai" size=20 value="<?php echo $dienThoai; ?>"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" size=40 value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'><input type="submit" value="Cập nhật" name="capnhat" /> </td>
            </tr>
        </table>
        <a href="./QLBanSua_HienThiDSKhachHang.php">Về trang thông tin khách hàng</a>
    </div>
</form>
<div id="notFound">
    <h1 class="error-message" style="color: red;">404 Not Found</h1>
    <p>Trang bạn đang tìm không tồn tại.</p>
</div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>