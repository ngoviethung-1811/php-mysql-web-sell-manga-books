<?php
include('../includes/admin_header.html');
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

    $noidungBang = '';

    if ($ptvc==='all')
        $txtPTVC = '';
    else $txtPTVC = "AND ptvanchuyen.maPTVC = '$ptvc'";
    if ($khuyenmai==='all')
        $txtKhuyenMai = '';
    else $txtKhuyenMai = "AND khuyenmai.maKM = '$khuyenmai'";
    if ($tinhTrang==-1)
        $txtTinhTrang = '';
    else $txtTinhTrang = "AND hoadon.tinhTrang = '$tinhTrang'";

    require("connect.php");

    $resultSearching = mysqli_query($conn, "SELECT hoadon.*,
    khuyenmai.code, nguoidung.hoTen, ptvanchuyen.tenPTVC
    FROM hoadon
    JOIN nguoidung ON hoadon.maND = nguoidung.maND
    JOIN ptvanchuyen ON hoadon.maPTVC = ptvanchuyen.maPTVC
    LEFT JOIN khuyenmai ON hoadon.maKM = khuyenmai.maKM
    WHERE nguoidung.hoTen LIKE '%$tenKH%'
    $txtPTVC $txtKhuyenMai $txtTinhTrang
    AND hoadon.ngayDat BETWEEN '$ngayDau' AND '$ngayCuoi'
    ORDER BY maHD");

    if(mysqli_num_rows($resultSearching)<>0) {
        $stt=1;
        while($rows=mysqli_fetch_assoc($resultSearching)) {
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
        $noidungBang .= "<tr><td colspan=10 align=center><font color=red>Không tìm thấy!</font></td></tr>";
    }
?>

<link rel="stylesheet" href="../css/tim.css">

<main>
<p id='pageCaption'>TRA CỨU THÔNG TIN HOÁ ĐƠN</p>
<p align=center><a id="goback" href='javascript:window.history.back(-1);'>Quay lại</a></p>
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
</main>

<script>
    var tab = document.getElementById('hienthi_HoaDon');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>