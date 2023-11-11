<?php
include('../includes/admin_header.html');
?>

<?php
    require("connect.php");

    $rowsPerPage=10;
    if (!isset($_GET['page'])) $_GET['page'] = 1;
    $offset =($_GET['page']-1)*$rowsPerPage;

    $result = mysqli_query($conn, "SELECT hoadon.*,
        khuyenmai.code, nguoidung.hoTen, ptvanchuyen.tenPTVC
        FROM hoadon
        JOIN nguoidung ON hoadon.maND = nguoidung.maND
        JOIN ptvanchuyen ON hoadon.maPTVC = ptvanchuyen.maPTVC
        LEFT JOIN khuyenmai ON hoadon.maKM = khuyenmai.maKM
        ORDER BY maHD LIMIT $offset, $rowsPerPage");
    $noidungBang = '';

    if(mysqli_num_rows($result)<>0) {
        $stt=1;
        while($rows=mysqli_fetch_assoc($result)) {
            $xacnhanHD = '';

            if ($stt%2==0) $noidungBang .= "<tr style='background-color: #b9e7f0;'>";
            else $noidungBang .= "<tr>";

            $noidungBang .= "<td class='centerText'>" . $rows['maHD'] . "</td>";
            $noidungBang .= "<td>" . $rows['hoTen'] . "</td>";
            $noidungBang .= "<td>" . $rows['tenPTVC'] . "</td>";

            if ($rows['code'] != null)
                $noidungBang .= "<td>" . $rows['code'] . "</td>";
            else 
                $noidungBang .= "<td></td>";

            $noidungBang .= "<td class='centerText'>" . date("d/m/Y", strtotime($rows['ngayDat'])) . "</td>";
            $noidungBang .= "<td class='centerText'>" . date("d/m/Y", strtotime($rows['ngayGiao'])) . "</td>";

            if ($rows['tinhTrang'] == 1)
                $noidungBang .= "<td> Đã giao </td>";
            else {
                $noidungBang .= "<td> Chưa giao </td>";
                $xacnhanHD = "<a href=./xacnhan_DonHang.php?maHD=".$rows['maHD'].">
                        <img src='../images/icon_check.png' alt='confirm' title='Xác nhận đơn hàng' style='height:1rem;'>
                    </a>";
            }

            $noidungBang .= "<td>" . number_format($rows['tongTienHang'], 0, ",", ".") . "đ</td>";
            $noidungBang .= "<td>" . number_format($rows['tongThanhToan'], 0, ",", ".") . "đ</td>";

            $noidungBang .= "<td>
                <a href=./xem_HoaDon.php?maHD=".$rows['maHD'].">
                    <img src='../images/icon_details.png' title='Xem chi tiết' style='height:1rem;'>
                </a>
                <a href=./xoa_HoaDon.php?maHD=".$rows['maHD'].">
                    <img src='../images/icon_delete.png' title='Xoá' style='height:1rem;'>
                </a>
                $xacnhanHD
                </td>";
            $noidungBang .= "</tr>";

            $stt++;
        }
    }
    else {
        $noidungBang .= "<td colspan=10>Không có bản ghi</td>";
    }

    $re = mysqli_query($conn, 'select * from hoadon');
    $numRows = mysqli_num_rows($re);
    $maxPage = ceil($numRows/$rowsPerPage);

    $phanTrang = "";

    if ($_GET['page'] > 1) {
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
    }
    else {
        $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
        $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
    }
    for ($i=1 ; $i<=$maxPage ; $i++){ 
        if ($i == $_GET['page'])
            $phanTrang .= "<a class='active'>".$i."</a>";
        else
            $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">".$i."</a>";
    }
    if ($_GET['page'] < $maxPage) {
        $phanTrang .= "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
    }
    else {
        $phanTrang .= "<a class='disable' href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
        $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
    }
?>

<?php
    if (isset($_POST['tenKH']))
        $tenKH = trim($_POST['tenKH']);
    else $tenKH = '';
    if (isset($_POST['ngayDau']))
        $ngayDau = $_POST['ngayDau'];
    else $ngayDau = date('Y-m-d', strtotime('-5 years'));
    if (isset($_POST['ngayCuoi']))
        $ngayCuoi = $_POST['ngayCuoi'];
    else $ngayCuoi = date('Y-m-d');
    if (isset($_POST['ptvc']))
        $ptvc = $_POST['ptvc'];
    else $ptvc = 'all';
    if (isset($_POST['khuyenmai']))
        $khuyenmai = $_POST['khuyenmai'];
    else $khuyenmai = 'all';
    if (isset($_POST['radTT']))
        $tinhTrang = $_POST['radTT'];
    else $tinhTrang = -1;

    $resPTVC = mysqli_query($conn, "SELECT * FROM ptvanchuyen");
    if(mysqli_num_rows($resPTVC)<>0) {
        $inputPTVC = "<select name='ptvc'>";
        $inputPTVC .= "<option value='all' selected>Tất cả</option>";
        while($rows=mysqli_fetch_assoc($resPTVC)){
            $selected = '';
            if(isset($_GET['ptvc']) && $_GET['ptvc']==$rows['maPTVC']) $selected = 'selected';
            $inputPTVC .= "<option value=${rows['maPTVC']} ".$selected.">
                    ${rows['tenPTVC']}
                    </option>";
        }
        $inputPTVC .= "</select>";
    }

    $resCodeKM = mysqli_query($conn, "SELECT * FROM khuyenmai");
    if(mysqli_num_rows($resCodeKM)<>0) {
        $inputCodeKM = "<select name='khuyenmai'>";
        $inputCodeKM .= "<option value='all' selected>Tất cả</option>";
        while($rows=mysqli_fetch_assoc($resCodeKM)){
            $selected = '';
            if(isset($_GET['khuyenmai']) && $_GET['khuyenmai']==$rows['maKM']) $selected = 'selected';
            $inputCodeKM .= "<option value=${rows['maKM']} ".$selected.">
                    ${rows['code']}
                    </option>";
        }
        $inputCodeKM .= "</select>";
    }
?>

<link rel="stylesheet" href="../css/hienthi.css">

<main>
<p id='pageCaption'>THÔNG TIN HOÁ ĐƠN</p>
<p align=center><button id='btnTimKiemForm' onclick="showSearchForm()">Tìm kiếm</button></p>
<form id='formTimKiem' action="tim_HoaDon.php" method="post" style="display: none;">
    <table id='tableTimKiem'>
        <tr>
            <td>Tên khách hàng:</td>
            <td><input type="text" name="tenKH" size=40 value="<?php echo $tenKH; ?>"></td>
        </tr>
        <tr>
            <td>Phương thức vận chuyển:</td>
            <td><?php echo $inputPTVC; ?></td>
        </tr>
        <tr>
            <td>Code khuyến mãi:</td>
            <td><?php echo $inputCodeKM; ?></td>
        </tr>
        <tr>
            <td>Ngày đầu:</td>
            <td><input type="date" name="ngayDau" value="<?php echo $ngayDau; ?>"></td>
        </tr>
        <tr>
            <td>Ngày cuối:</td>
            <td><input type="date" name="ngayCuoi" value="<?php echo $ngayCuoi; ?>"></td>
        </tr>
        <tr>
            <td>Tình trạng:</td>
            <td>
                <input type="radio" name="radTT" value=-1<?php if(isset($_POST['radTT'])&&$_POST['radTT']=='-1') echo 'checked="checked"';?> checked/>
                    Tất cả 
                <input type="radio" name="radTT" value=0<?php if(isset($_POST['radTT'])&&$_POST['radTT']=='0') echo 'checked="checked"';?>/> 
                    Chưa giao 
                <input type="radio" name="radTT" value=1 <?php if(isset($_POST['radTT'])&&$_POST['radTT']=='1') echo 'checked="checked"';?>/>
                    Đã giao<br>
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center>
                <input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='hideSearchForm()'/>
                <input type='submit' name='tim' value='Tìm' id='btnTim'>
                <input type='reset' name='reset' value='Làm mới' id='btnReset'>
            </td>
        </tr>
    </table>
</form>
<table border='1'>
    <tr>
        <th>Mã hoá đơn</th>
        <th>Tên khách hàng</th>
        <th>Phương thức vận chuyển</th>
        <th>Code khuyến mãi</th>
        <th>Ngày đặt</th>
        <th>Ngày giao</th>
        <th>Tình trạng</th>
        <th>Tổng tiền hàng</th>
        <th>Tổng thanh toán</th>
        <th>Thao tác</th>
    </tr>
    <?php echo $noidungBang; ?>
</table>
<div style='text-align: center; margin: 0.2rem;'>
    <div class='pagination'><?php echo $phanTrang; ?></div>
</div>
</main>

<script>
    var tab = document.getElementById('hienthi_HoaDon');
    tab.classList.add('active');
</script>

<script src="../javascript/hienthi_form_timkiem.js"></script>

<?php
include('../includes/footer.php');
?>