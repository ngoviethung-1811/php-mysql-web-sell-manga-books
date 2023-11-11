<?php
include('../includes/admin_header.html');
?>

<?php
    require("connect.php");
    
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

        $noidungCTHD = '';

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
                $tongTH = number_format($rows['tongTienHang'], 0, ",", ".") . "đ";
                $tongTT = number_format($rows['tongThanhToan'], 0, ",", ".") . "đ";
            }
        }

        $rowsPerPage = 5;
        if (!isset($_GET['page'])) $_GET['page'] = 1;
        $offset =($_GET['page']-1)*$rowsPerPage;

        $resultCTHD = mysqli_query($conn, "SELECT chitiethoadon.maTruyen, truyen.tenTruyen, chitiethoadon.soLuong,
            chitiethoadon.donGia FROM chitiethoadon, truyen WHERE chitiethoadon.maTruyen=truyen.maTruyen
            AND maHD='$maHD' LIMIT $offset, $rowsPerPage");

        if(mysqli_num_rows($resultCTHD)<>0) {
            $stt=1;
            while($rows=mysqli_fetch_assoc($resultCTHD)) {
                if ($stt%2==0) $noidungCTHD .= "<tr style='background-color: #b9e7f0;'>";
                else $noidungCTHD .= "<tr>";

                $noidungCTHD .= "<td class='centerText'>" . $rows['maTruyen'] . "</td>";
                $noidungCTHD .= "<td>" . $rows['tenTruyen'] . "</td>";
                $noidungCTHD .= "<td>" . $rows['soLuong'] . "</td>";
                $noidungCTHD .= "<td>" . number_format($rows['donGia'], 0, ",", ".") . "đ</td>";

                $noidungCTHD .= "</tr>";

                $stt++;
            }
        }

        $re =  mysqli_query($conn, "SELECT chitiethoadon.maTruyen, truyen.tenTruyen, chitiethoadon.soLuong,
            chitiethoadon.donGia FROM chitiethoadon, truyen WHERE chitiethoadon.maTruyen=truyen.maTruyen
            AND maHD='$maHD'");
        $numRows = mysqli_num_rows($re);
        $maxPage = ceil($numRows/$rowsPerPage);

        $phanTrang = "";

        if ($_GET['page'] > 1) {
            $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?maHD=".$maHD."&page=1> << </a>";
            $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?maHD=".$maHD."&page=".($_GET['page']-1)."> < </a>";
        }
        else {
            $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?maHD=".$maHD."&page=1> << </a>";
            $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?maHD=".$maHD."&page=".($_GET['page']-1)."> < </a>";
        }
        for ($i=1 ; $i<=$maxPage ; $i++){ 
            if ($i == $_GET['page'])
                $phanTrang .= "<a class='active'>".$i."</a>";
            else
                $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']. "?maHD=".$maHD."&page=".$i.">".$i."</a>";
        }
        if ($_GET['page'] < $maxPage) {
            $phanTrang .= "<a href=". $_SERVER['PHP_SELF']."?maHD=".$maHD."&page=".($_GET['page']+1)."> > </a>";
            $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?maHD=".$maHD."&page=".$maxPage."> >> </a>";
        }
        else {
            $phanTrang .= "<a class='disable' href=". $_SERVER['PHP_SELF']."?maHD=".$maHD."&page=".($_GET['page']+1)."> > </a>";
            $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?maHD=".$maHD."&page=".$maxPage."> >> </a>";
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<link rel="stylesheet" href="../css/xem.css">

<main>
    <p id='pageCaption'>XEM CHI TIẾT HOÁ ĐƠN</p>
    <table>
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
    </table>

    <table id="tableCTHD" border='1'>
        <tr>
            <th>Mã truyện</th>
            <th>Tên truyện</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
        </tr>
        <?php echo $noidungCTHD; ?>
    </table>
    <div style='text-align: center; margin: 0.2rem;'>
        <div class='pagination'><?php echo $phanTrang; ?></div>
    </div>

    <p align=center><a id="goback" href="./hienthi_HoaDon.php">Quay lại</a></p>
</main>

<script>
    var tab = document.getElementById('hienthi_HoaDon');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>