<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $maNXB = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat'])) 
        {
            $tenNXB = trim($_POST['tenNXB']);
            $diaChi = trim($_POST['diaChi']);
            $sdt = trim($_POST['sdt']);
            $sql = "UPDATE nhaxuatban SET tenNXB='$tenNXB', diaChi='$diaChi', sdt='$sdt' WHERE maNXB='$maNXB'";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * FROM nhaxuatban WHERE maNXB='$maNXB'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenNXB = $row['tenNXB'];
            $diaChi = $row['diaChi'];
            $sdt = $row['sdt'];
        } else {
            $tenNXB = '';
            $diaChi = '';
            $sdt = '';
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA NHÀ XUẤT BẢN</p>
    <form  action="" method="post">
        <table >
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã NXB:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maNXB" value="<?php echo $maNXB; ?>"/></td>
            </tr>
            <tr>
                <td>Tên NXB:</td>
                <td><input type="text" size=40 name="tenNXB" value="<?php echo $tenNXB; ?>"/></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" size=40 name="diaChi" value="<?php echo $diaChi; ?>"/></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" size=20 name="sdt" value="<?php echo $sdt; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_NXB.php">Quay lại</a></p>
    </form>
</main>
    
<script>
    var tab = document.getElementById('hienthi_NXB');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>