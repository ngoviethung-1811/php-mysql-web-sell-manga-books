<?php
include('../includes/admin_header.html');
?>

<?php
    require("connect.php");

    function xoaHoaDon($maHD) {
        global $conn;

        $result1 = mysqli_query($conn, "DELETE FROM chitiethoadon
            WHERE maHD = '$maHD'");

        $result2 = mysqli_query($conn, "DELETE FROM hoadon
        WHERE maHD = '$maHD'");

        return $result1 && $result2;
    }
    
    if (isset($_GET['maHD'])) {
        $maHD = $_GET['maHD'];
        if (isset($_POST['tenKH']))
            $tenKH = trim($_POST['tenKH']);
        else $tenKH = '';
        if (isset($_POST['ptvc']))
            $ptvc = trim($_POST['ptvc']);
        else $ptvc = '';
        if (isset($_POST['code']))
            $code = trim($_POST['code']);
        else $code = '';
        if (isset($_POST['ngayDat']))
            $ngayDat = trim($_POST['ngayDat']);
        else $ngayDat = '';
        if (isset($_POST['ngayGiao']))
            $ngayGiao = trim($_POST['ngayGiao']);
        else $ngayGiao = '';
        if (isset($_POST['radTT']))
            $tinhTrang = trim($_POST['radTT']);
        else $tinhTrang = '';
        if (isset($_POST['tongTH']))
            $tongTH = trim($_POST['tongTH']);
        else $tongTH = '';
        if (isset($_POST['tongTT']))
            $tongTT = trim($_POST['tongTT']);
        else $tongTT = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaHoaDon($maHD);
            
            if ($kqXoa) {
                $maHD = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $result = mysqli_query($conn, "SELECT hoadon.*,
            khuyenmai.code, nguoidung.hoTen, ptvanchuyen.tenPTVC
            FROM hoadon
            JOIN nguoidung ON hoadon.maND = nguoidung.maND
            JOIN ptvanchuyen ON hoadon.maPTVC = ptvanchuyen.maPTVC
            LEFT JOIN khuyenmai ON hoadon.maKM = khuyenmai.maKM
            WHERE maHD='$maHD'");
        
        if(mysqli_num_rows($result)<>0) {
            while($rows=mysqli_fetch_assoc($result)) {
                $tenKH = $rows['hoTen'];
                $ptvc = $rows['tenPTVC'];
                $code = $rows['code'];
                $ngayDat = $rows['ngayDat'];
                $ngayGiao = $rows['ngayGiao'];
                $tinhTrang = $rows['tinhTrang'];
                $_POST['radTT'] = $rows['tinhTrang'];
                $tongTH = number_format($rows['tongTienHang'], 0, ",", ".")."đ";
                $tongTT = number_format($rows['tongThanhToan'], 0, ",", ".")."đ";
            }
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<link rel="stylesheet" href="../css/xoa.css">

<main>
    <p id='pageCaption'>XOÁ HOÁ ĐƠN</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã hoá đơn:</td>
                <td><input type="text" disabled name='maKH' value='<?php echo $maHD ?>'></td>
            </tr>
            <tr>
                <td>Tên khách hàng:</td>
                <td><input type="text" disabled name="tenKH" size=40 value="<?php echo $tenKH; ?>"></td>
            </tr>
            <tr>
                <td>Phương thức vận chuyển:</td>
                <td><input type="text" disabled name="ptvc" size=40 value="<?php echo $ptvc; ?>"></td>
            </tr>
            <tr>
                <td>Code khuyến mãi:</td>
                <td><input type="text" disabled name="maKM" size=40 value="<?php echo $code; ?>"></td>
            </tr>
            <tr>
                <td>Ngày đặt:</td>
                <td><input type="date" disabled name="ngayDat" value="<?php echo $ngayDat; ?>"></td>
            </tr>
            <tr>
                <td>Ngày giao:</td>
                <td><input type="date" disabled name="ngayGiao" value="<?php echo $ngayGiao; ?>"></td>
            </tr>
            <tr>
                <td>Tình trạng:</td>
                <td>
                    <input type="radio" disabled name="radTT" value=0<?php if(isset($_POST['radTT'])&&$_POST['radTT']=='0') echo 'checked="checked"';?> checked/> Chưa giao 
                    <input type="radio" disabled name="radTT" value=1 <?php if(isset($_POST['radTT'])&&$_POST['radTT']=='1') echo 'checked="checked"';?>/>
                            Đã giao<br>
                </td>
            </tr>
            <tr>
                <td>Tổng tiền hàng:</td>
                <td><input type="text" disabled name="tongTH" size=20 value="<?php echo $tongTH; ?>"></td>
            </tr>
            <tr>
                <td>Tổng thanh toán:</td>
                <td><input type="text" disabled name="tongTT" size=20 value="<?php echo $tongTT; ?>"></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_HoaDon.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_HoaDon');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>