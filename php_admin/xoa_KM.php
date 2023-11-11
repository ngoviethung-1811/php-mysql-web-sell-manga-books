<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");

    function xoaKM($maKM) {
        global $conn;

        $query = "DELETE FROM khuyenmai WHERE maKM='$maKM'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maKM = $_GET['id'];
        if(isset($_POST['loaiKM']))  
            $loaiKM=trim($_POST['loaiKM']);
        else $loaiKM='';
        if(isset($_POST['giamGia']))  
            $giamGia=trim($_POST['giamGia']); 
        else $giamGia='';
        if(isset($_POST['code']))  
            $code=trim($_POST['code']); 
        else $code='';
        if(isset($_POST['gtDonHang']))  
            $gtDonHang=trim($_POST['gtDonHang']); 
        else $gtDonHang='';
        if(isset($_POST['ngayBD']))  
            $ngayBD=$_POST['ngayBD']; 
        else $ngayBD=date('Y-m-d');
        if(isset($_POST['ngayKT']))  
            $ngayKT=$_POST['ngayKT']; 
        else $ngayKT=date('Y-m-d');

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaKM($maKM);
            
            if ($kqXoa) {
                $maKM = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT *, tenLKM FROM khuyenmai, loaikhuyenmai 
            WHERE khuyenmai.maLKM=loaikhuyenmai.maLKM AND maKM='$maKM'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)<>0) {
            while($rows=mysqli_fetch_assoc($result)) {
                $loaiKM = $rows['tenLKM'];
                $code = $rows['code'];
                $giamGia = number_format($rows['giamGia'], 0, ",", ".") . "đ";
                $gtDonHang = number_format($rows['gtDonHang'], 0, ",", ".") . "đ";
                $ngayBD = $rows['ngayBD'];
                $ngayKT = $rows['ngayKT'];
            }
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ KHUYẾN MÃI</p>
    <form action="" method="post">
    <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã khuyến mãi:</td>
                <td><input type="text" disabled size=20 name="maKM" value="<?php echo $maKM; ?>"/></td>
            </tr>
            <tr>
                <td>Loại khuyến mãi:</td>
                <td><input type="text" disabled size=20 name='loaiKM' value='<?php echo $loaiKM ?>'></td>
            </tr>
            <tr>
                <td>Code:</td>
                <td><input type="text" disabled size=40 name="code" value="<?php echo $code ?>"/></td>
            </tr>
            <tr>
                <td>Giảm giá:</td>
                <td><input type="text" disabled size=20 name="giamGia" value="<?php echo $giamGia ?>"/></td>
            </tr>
            <tr>
                <td>Giá trị đơn hàng:</td>
                <td><input type="text" disabled size=20 name="gtDonHang" value="<?php echo $gtDonHang ?>"/></td>
            </tr>
            <tr>
                <td>Ngày bắt đầu:</td>
                <td><input type="date" disabled name="ngayBD" value="<?php echo $ngayBD; ?>"/></td>
            </tr>
            <tr>
                <td>Ngày kết thúc:</td>
                <td><input type="date" disabled name="ngayKT" value="<?php echo $ngayKT; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_KM.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_KM');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>