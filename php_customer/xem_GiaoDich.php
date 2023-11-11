<?php 
include('../includes/header.html');
?>

<style> 
    main {
        padding: 1rem;
    }
    table {
        border-collapse:collapse;
        margin: 1rem auto;
    }
    #tableCTHD {
        border-collapse:collapse;
        margin: 0.5rem auto;
        width: 55%;
    }
    #tableCTHD th {
        padding: 0.5rem;
        text-align: center;
        background: #f7baf1;
    }
    #tableCTHD td {
        padding: 0.3rem;
    }
    td input[type=text], input[type=date] {
        background: #f7e8bc;
        color: black;
    }
    th {
        padding: 0.5rem;
        text-align: center;
        background: #f7baf1;
    }
    td {
        padding: 0.5rem;
    }
    .info-form {
        width: fit-content;
        margin: 0 auto;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        border-radius: 5%;
    }
    .info-form h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 1rem;
        color: #333;
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
    .centerText {
        text-align: center;
    }
    .txtXemChiTiet {
        text-decoration: none;
        color: blue;
    }
    .txtXemChiTiet:hover {
        color: orange;
    }
    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
        color: #fff;
        position: relative;
    }
    input[type="date"]::-webkit-datetime-edit-year-field{
        position: absolute !important;
        border-left:1px solid black;
        color:#000;
        left: 56px;
    }
    input[type="date"]::-webkit-datetime-edit-month-field{
        position: absolute !important;
        border-left:1px solid black;
        color:#000;
        left: 26px;
    }
    input[type="date"]::-webkit-datetime-edit-day-field{
        position: absolute !important;
        color:#000;
        left: 4px;
    }
</style>

<?php  
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }

    $thongbao='';

    $user = $_SESSION['user'];

    require("connect.php");

    $maND = $user['id'];

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

<?php    
    if (isset($_GET['maHD'])) {
        $maHD = $_GET['maHD'];
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
            khuyenmai.code, ptvanchuyen.tenPTVC
            FROM hoadon
            JOIN ptvanchuyen ON hoadon.maPTVC = ptvanchuyen.maPTVC
            LEFT JOIN khuyenmai ON hoadon.maKM = khuyenmai.maKM
            WHERE maHD='$maHD'");
        
        if(mysqli_num_rows($result)<>0) {
            while($rows=mysqli_fetch_assoc($result)) {
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

        $resultCTHD = mysqli_query($conn, "SELECT truyen.anhBia, chitiethoadon.maTruyen, truyen.tenTruyen, chitiethoadon.soLuong,
            chitiethoadon.donGia FROM chitiethoadon, truyen WHERE chitiethoadon.maTruyen=truyen.maTruyen
            AND maHD='$maHD'");

        if(mysqli_num_rows($resultCTHD)<>0) {
            $stt=1;
            while($rows=mysqli_fetch_assoc($resultCTHD)) {
                $noidungCTHD .= "<tr>";

                $noidungCTHD .= "<td class='centerText'><img src='../images/" . $rows['anhBia'] . "' width='100'/></td>";
                $noidungCTHD .= "<td>" . $rows['tenTruyen'] . "</td>";
                $noidungCTHD .= "<td>" . $rows['soLuong'] . "</td>";
                $noidungCTHD .= "<td>" . number_format($rows['donGia'], 0, ",", ".") . "đ</td>";
                $thanhTien = $rows['donGia'] * $rows['soLuong'];
                $noidungCTHD .= "<td>" . number_format($thanhTien, 0, ",", ".") . "đ</td>";

                $noidungCTHD .= "</tr>";

                $stt++;
            }
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <div class='info-form'>
        <h2>LỊCH SỬ GIAO DỊCH</h2>
        <table>
            <tr>
                <td colspan=2><?php echo $thongbao; ?></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><?php echo $hoTen ?></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><?php echo $diaChi ?></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><?php echo $sdt ?></td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./thongke_GiaoDich.php">Quay lại</a></p>
    </div>

    <div align=center style='padding: 1rem;'><h3>XEM CHI TIẾT GiAO DỊCH</h3></div>
    
    <table>
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
                <input type="radio" disabled name="radTT" value=0 <?php if(isset($_POST['radTT'])&&$_POST['radTT']=='0') echo 'checked="checked"';?> checked/> Chưa giao 
                <input type="radio" disabled name="radTT" value=1 <?php if(isset($_POST['radTT'])&&$_POST['radTT']=='1') echo 'checked="checked"';?>/>
                        Đã giao<br>
            </td>
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
            <th>Ảnh bìa</th>
            <th>Tên truyện</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php echo $noidungCTHD; ?>
    </table>
</main>

<?php include('../includes/footer.php'); ?>