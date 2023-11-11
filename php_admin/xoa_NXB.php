<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");	

    function xoaNXB($maNXB) {
        global $conn;

        $query = "DELETE FROM nhaxuatban WHERE maNXB='$maNXB'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maNXB = $_GET['id'];
        if (isset($_POST['tenNXB']))
            $tenNXB = trim($_POST['tenNXB']);
        else $tenNXB = '';
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
            $kqXoa = xoaNXB($maNXB);
            
            if ($kqXoa) {
                $maNXB = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM nhaxuatban 
                WHERE maNXB = '$maNXB'";
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
    <p id='pageCaption'>XOÁ NHÀ XUẤT BẢN</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã NXB:</td>
                <td><input type="text" disabled size=20 name="maNXB" value="<?php echo $maNXB; ?>"/></td>
            </tr>
            <tr>
                <td>Tên NXB:</td>
                <td><input type="text" disabled size=40 name="tenNXB" value="<?php echo $tenNXB; ?>"/></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" disabled size=40 name="diaChi" value="<?php echo $diaChi; ?>"/></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" disabled size=20 name="sdt" value="<?php echo $sdt; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
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
