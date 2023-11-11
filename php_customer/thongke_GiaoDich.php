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
        width: 100%;
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
    $result = mysqli_query($conn, "SELECT hoadon.*,
        khuyenmai.code, ptvanchuyen.tenPTVC
        FROM hoadon
        JOIN ptvanchuyen ON hoadon.maPTVC = ptvanchuyen.maPTVC
        LEFT JOIN khuyenmai ON hoadon.maKM = khuyenmai.maKM
        WHERE maND='$maND'
        ORDER BY ngayDat DESC");
    $noidungGD = '';

    if(mysqli_num_rows($result)<>0) {
        $noidungGD = "<table border='1'>
                        <tr>
                            <th>STT</th>
                            <th>Ngày đặt</th>
                            <th>Ngày giao</th>
                            <th>Tình trạng</th>
                            <th>Phương thức vận chuyển</th>
                            <th>Code khuyến mãi</th>
                            <th>Tổng tiền hàng</th>
                            <th>Tổng thanh toán</th>
                            <th></th>
                        </tr>";

        $stt=1;
        while($rows=mysqli_fetch_assoc($result)) {
            if ($stt%2==0) $noidungGD .= "<tr style='background-color: #b9e7f0;'>";
            else $noidungGD .= "<tr>";

            $noidungGD .= "<td class='centerText'>" . $stt . "</td>";
            $noidungGD .= "<td class='centerText'>" . date("d/m/Y", strtotime($rows['ngayDat'])) . "</td>";
            $noidungGD .= "<td class='centerText'>" . date("d/m/Y", strtotime($rows['ngayGiao'])) . "</td>";
            if ($rows['tinhTrang'] == 1)
                $noidungGD .= "<td> Đã giao </td>";
            else
                $noidungGD .= "<td> Chưa giao </td>";
            $noidungGD .= "<td>" . $rows['tenPTVC'] . "</td>";
            if ($rows['code'] != null)
                $noidungGD .= "<td>" . $rows['code'] . "</td>";
            else 
                $noidungGD .= "<td></td>";
            $noidungGD .= "<td>" . number_format($rows['tongTienHang'], 0, ",", ".") . "đ</td>";
            $noidungGD .= "<td>" . number_format($rows['tongThanhToan'], 0, ",", ".") . "đ</td>";

            $noidungGD .= "<td class='centerText'>
                <a class='txtXemChiTiet' href=./xem_GiaoDich.php?maHD=".$rows['maHD'].">
                    Xem chi tiết
                </a>
                </td>";
            $noidungGD .= "</tr>";

            $stt++;
        }
        $noidungGD .= "</table>";
    }
    else {
        $noidungGD = "<p align=center>Bạn chưa thực hiện giao dịch nào</p>";
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
        <p align=center><a id="goback" href="./profile.php">Quay lại</a></p>
    </div>
    <?php echo $noidungGD; ?>
</main>
<?php include('../includes/footer.php'); ?>