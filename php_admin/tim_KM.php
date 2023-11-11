<?php
include('../includes/admin_header.html');
?>

<?php
    if (isset($_POST['loaiKM']))
        $loaiKM = trim($_POST['loaiKM']);
    else $loaiKM = '';
    if (isset($_POST['ngayDau']))
        $ngayDau = trim($_POST['ngayDau']);
    else $ngayDau = date('Y-m-d', strtotime('-5 years'));
    if (isset($_POST['ngayCuoi']))
        $ngayCuoi = trim($_POST['ngayCuoi']);
    else $ngayCuoi = date('Y-m-d');

    $noidungBang = '';

    if ($loaiKM==='all')
        $txtLKM = '';
    else $txtLKM = "AND loaikhuyenmai.maLKM = '$loaiKM'";

    require("connect.php");

    $query = "SELECT *, tenLKM FROM khuyenmai, loaikhuyenmai WHERE khuyenmai.maLKM = loaikhuyenmai.maLKM
        $txtLKM AND ngayBD BETWEEN '$ngayDau' AND '$ngayCuoi' ORDER BY maKM";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) <> 0) {
        $stt = 1;
        while ($rows = mysqli_fetch_assoc($result)) {
            if ($stt%2==0) $noidungBang .= "<tr style='background-color: #b9e7f0;'>";
            else $noidungBang .= "<tr>";

            $noidungBang .= "<td class='centerText'>" . $rows['maKM'] . "</td>";
            $noidungBang .= "<td>" . $rows['tenLKM'] . "</td>";
            $noidungBang .= "<td>" . $rows['code'] . "</td>";
            $noidungBang .= "<td>" . number_format($rows['giamGia'], 0, ",", ".") . "đ</td>";
            $noidungBang .= "<td>" . number_format($rows['gtDonHang'], 0, ",", ".") . "đ</td>";
            $noidungBang .= "<td>" . date("d/m/Y", strtotime($rows['ngayBD'])) . "</td>";
            $noidungBang .= "<td>" . date("d/m/Y", strtotime($rows['ngayKT'])) . "</td>";

            $noidungBang .= "<td>
                <a href='./sua_KM.php?id=" . $rows['maKM'] . "'>
                    <img src='../images/icon_edit.png' title='Sửa' style='height:1rem;'>
                </a>
                <a href='./xoa_KM.php?id=" . $rows['maKM'] . "'>
                    <img src='../images/icon_delete.png' title='Xoá' style='height:1rem;'>
                </a>
                </td>";
            $noidungBang .= "</tr>";

            $stt++;
        }
    } else {
        $noidungBang .= "<tr><td colspan=8 align=center><font color=red>Không tìm thấy!</font></td></tr>";
    }
?>

<link rel="stylesheet" href="../css/tim.css">

<main>
    <p id='pageCaption'>TRA CỨU THÔNG TIN KHUYẾN MÃI</p>
    <p align=center><a id="goback" href='javascript:window.history.back(-1);'>Quay lại</a></p>
    <table border='1'>
        <tr>
            <th>Mã khuyến mãi</th>
            <th>Loại khuyến mãi</th>
            <th>Code</th>
            <th>Giảm giá</th>
            <th>Giá trị đơn hàng</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Thao tác</th>
        </tr>
        <?php echo $noidungBang; ?>
    </table>
</main>

<script>
    var tab = document.getElementById('hienthi_KM');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>
