<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/baocao.css">

<?php
    if ($_SESSION['user']['role']!='admin'){
        header('Location: ../html/permission_denied.html');
        exit();
    }
?>

<?php
    if (isset($_POST['startDate']))
        $startDate = $_POST['startDate'];
    else $startDate = date('Y-m-d', strtotime('-5 years'));
    if (isset($_POST['endDate']))
        $endDate = $_POST['endDate'];
    else $endDate = date('Y-m-d');

    if (isset($_POST['reset'])) {
        $startDate = date('Y-m-d', strtotime('-5 years'));
        $endDate = date('Y-m-d');
    }
?>

<main>
    <p id='pageCaption'>BÁO CÁO DOANH THU</p>
    <form action="" method="post">
        <table id='tableTimKiem'>
            <tr>
                <td>Ngày bắt đầu:</td>
                <td><input type="date" name="startDate" value="<?php echo $startDate; ?>"></td>
            </tr>
            <tr>
                <td>Ngày kết thúc:</td>
                <td><input type="date" name="endDate" value="<?php echo $endDate; ?>"></td>
            </tr>
            <tr>
                <td colspan=2 align=center>
                    <input type='submit' name='reset' value='Làm mới' id='btnReset'>
                    <input type='submit' name='tinh' value='Lập báo cáo' id='btnTinh'>
                </td>
            </tr>
        </table>
    </form>
</main>

<?php
    require("connect.php");

    if (isset($_POST['tinh'])) {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];

        $result = mysqli_query($conn, "SELECT hoadon.*,
            khuyenmai.code, nguoidung.hoTen AS tenKhachHang, ptvanchuyen.tenPTVC
            FROM hoadon
            JOIN nguoidung ON hoadon.maND = nguoidung.maND
            JOIN ptvanchuyen ON hoadon.maPTVC = ptvanchuyen.maPTVC
            LEFT JOIN khuyenmai ON hoadon.maKM = khuyenmai.maKM
            WHERE ngayDat BETWEEN '$startDate' AND '$endDate'
            ORDER BY maHD");

        if (mysqli_num_rows($result)<>0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>Mã hoá đơn</th>
                    <th>Tên khách hàng</th>
                    <th>Phương thức vận chuyển</th>
                    <th>Code khuyến mãi</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Tình trạng</th>
                    <th>Tổng tiền hàng</th>
                    <th>Tổng thanh toán</th>
                </tr>";

            $sumTongThanhToan = 0;

            $stt=1;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($stt%2==0) echo "<tr style='background-color: #b9e7f0;'>";
                else echo "<tr>";
                echo "<td class='centerText'>" . $row['maHD'] . "</td>";
                echo "<td>" . $row['tenKhachHang'] . "</td>";
                echo "<td>" . $row['tenPTVC'] . "</td>";
                echo "<td>" . $row['code'] . "</td>";
                echo "<td class='centerText'>" . date("d/m/Y", strtotime($row['ngayDat'])) . "</td>";
                echo "<td class='centerText'>" .date("d/m/Y", strtotime($row['ngayGiao'])) . "</td>";

                if ($row['tinhTrang'] == 1) {
                    echo "<td> Đã giao </td>";
                } else {
                    echo "<td> Chưa giao </td>";
                }

                echo "<td>" . number_format($row['tongTienHang'], 0, ",", ".") . "đ</td>";
                echo "<td>" . number_format($row['tongThanhToan'], 0, ",", ".") . "đ</td>";
                echo "</tr>";

                $sumTongThanhToan += $row['tongThanhToan'];
                $stt++;
            }

            echo "</table>";

            echo "<p align=center id='output'><b>Tổng doanh thu: " . number_format($sumTongThanhToan, 0, ",", ".") . "đ</b></p>";
        } 
        else {
            echo "<table border='1'>";
            echo "<tr>
                    <th>Mã hoá đơn</th>
                    <th>Tên khách hàng</th>
                    <th>Phương thức vận chuyển</th>
                    <th>Code khuyến mãi</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Tình trạng</th>
                    <th>Tổng tiền hàng</th>
                    <th>Tổng thanh toán</th>
                </tr>";
            echo "<tr><td colspan=9 align=center>Không có bản ghi</td></tr>";
            echo "</table>";
        }
    }
?>

<script>
    var tab = document.getElementById('baocao');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>
