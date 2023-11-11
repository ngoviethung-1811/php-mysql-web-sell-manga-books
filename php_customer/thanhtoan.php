<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
    table {
        border-collapse:collapse;
        margin: 1rem;
    }
    td {
        padding: 0.5rem;
    }
    #hd {
        border-collapse:collapse;
        margin: 1rem auto;
        width: 70%;
        text-align: center;
    }
    #hd th {
        padding: 0.5rem;
        text-align: center;
        background: #f7baf1;
        border: 0.5px solid #7d7d7d;
    }
    #hd td {
        padding: 0.5rem;
        border: 0.5px solid gainsboro;
    }
    #gtDonHang {
        border-collapse:collapse;
        margin: 1rem auto;
        width: 30%;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
    }
    #gtDonHang td {
        padding: 0.5rem;
    }
    .info-form {
        width: fit-content;
        margin: 0 auto;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        border-radius: 3%;
    }
    .info-form h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 1rem;
        color: #333;
    }
    .linkChucNang {
        text-decoration: none;
        color: blue;
        opacity: 0.7;
    }
    .linkChucNang:hover {
        opacity: 1;
    }
    #txtCodeKM {
        background-color: white;
        color: #333333;
        border-radius: 4px;
        border-color: #dbdad7;
        padding: 0.5rem;
    }
    #btnUseCode {
        border-radius: 4px;
        font-weight: 500;
        padding: 0.5rem;
        text-align: center;
        cursor: pointer;
        background: #338dbc;
        color: white;
        opacity: 0.9;
    }
    #btnUseCode:hover {
        opacity: 1;
    }
    .txtCC {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    label {
        margin-bottom: 10px;
        display: block;
    }
    #formCC {
        width: 50%;
        margin: 0 auto;
        background-color: #f2f2f2;
        padding: 1rem;
        border-radius: 3%;
    }
    #btnThanhToan {
        background-color: #04AA6D;
        color: white;
        padding: 1rem;
        margin: 0.5rem 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 1rem;
    }
    #btnThanhToan:hover {
        background-color: #45a049;
    }
</style>

<?php

    if (isset($_POST['code']))
        $code = trim($_POST['code']);
    else $code = '';
    if (isset($_POST['cardNumber']))
        $cardNumber = trim($_POST['cardNumber']);
    else $cardNumber = '';
    if (isset($_POST['cardName']))
        $cardName = trim($_POST['cardName']);
    else $cardName = '';
    if (isset($_POST['validDay']))
        $validDay = trim($_POST['validDay']);
    else $validDay = '';
    if (isset($_POST['tongCong']))
        $tongCong = $_POST['tongCong'];
    else $tongCong = 0;
    if (isset($_POST['txtGiamGia']))
        $txtGiamGia = $_POST['txtGiamGia'];
    else $txtGiamGia = '-';
    if (isset($_POST['maKhuyenMai']))
        $maKhuyenMai = $_POST['maKhuyenMai'];
    else $maKhuyenMai = '';
    if (isset($_POST['ptvc']))
        $ptvc = trim($_POST['ptvc']);
    else $ptvc = '';

    $thongbaoCodeKM = '';
    $thongbao = '';
    $tongTien = 0;
    $noidungHD = '';

    if (isset($_SESSION['user'])) {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            require("connect.php");

            $user = $_SESSION['user'];

            $maND = $user['id'];    
            $query = "SELECT hoTen, email, sdt, diaChi FROM nguoidung WHERE maND = '$maND'";
            $resultND = mysqli_query($conn, $query);
            if ($resultND) {
                $userData = mysqli_fetch_assoc($resultND);
                $hoTen = $userData['hoTen'];
                $sdt = $userData['sdt'];
                $diaChi = $userData['diaChi'];
            }
            foreach ($_SESSION['cart'] as $cartItem) {
                $noidungHD .= "<tr>";
                $noidungHD .= "<td>".$cartItem['tenTruyen']."</td>";
                $noidungHD .= "<td>".$cartItem['soLuong']."</td>";
                $noidungHD .= "<td>".number_format($cartItem['donGia'], 0, ",", ".")."đ</td>";
                $thanhTien = $cartItem['donGia'] * $cartItem['soLuong'];
                $tongTien += $thanhTien;
                $noidungHD .= "<td>".number_format($thanhTien, 0, ",", ".")."đ</td>";
                $noidungHD .= "</tr>";
            }

            if ($tongCong == 0) $tongCong = $tongTien;

            if (isset($_POST['useCode']) && isset($_POST['code']) && $_POST['code']!='') {
                $resultCodeValid = mysqli_query($conn, "SELECT * FROM khuyenmai WHERE code='$code'
                    AND ngayBD <= CURRENT_DATE() AND ngayKT >= CURRENT_DATE()");
                if (mysqli_num_rows($resultCodeValid)<>0) {
                    $km = mysqli_fetch_assoc($resultCodeValid);
                    
                    $maKM = $km['maKM'];
                    $giamGia = $km['giamGia'];
                    $gtDonHang = $km['gtDonHang'];

                    if ($tongTien<$gtDonHang) {
                        $thongbaoCodeKM = "<font color=red size='0.5rem'>Mã chỉ áp dụng cho đơn hàng có giá trị 
                        từ ".number_format($gtDonHang, 0, ",", ".")."đ</font>";
                    }
                    else {
                        $resultCodeUsed = mysqli_query($conn, "SELECT maHD FROM hoadon WHERE
                            maND='$maND' AND maKM='$maKM'");
                        
                        if (mysqli_num_rows($resultCodeUsed)<>0) {
                            $thongbaoCodeKM = "<font color=red size='0.5rem'>Bạn đã sử dụng mã giảm giá này</font>";
                        }
                        else {
                            $maKhuyenMai = $maKM;
                            $thongbaoCodeKM = "<font color=green size='0.5rem'>Mã giảm giá được áp dụng</font>";
                            $maLKM = $km['maLKM'];
                            $resultLKM = mysqli_query($conn, "SELECT tenLKM FROM loaikhuyenmai WHERE maLKM='$maLKM'");
                            if (mysqli_num_rows($resultLKM)<>0) $loaiKM = mysqli_fetch_assoc($resultLKM);
                            else $loaiKM = '';
                            $tenLKM = $loaiKM['tenLKM'];
                            switch ($tenLKM) {
                                case 'Khuyến mãi %':
                                    $txtGiamGia = $giamGia. "%";
                                    $tongCong = $tongTien - $tongTien*$giamGia/100;
                                    break;
                                case 'Khuyến mãi Giá':
                                    $txtGiamGia = $giamGia. "đ";
                                    $tongCong = $tongTien - $giamGia;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                }
                else {
                    $thongbaoCodeKM = "<font color=red size=0.5rem>Không tìm thấy mã giảm giá</font>";
                }
            }

            if (isset($_POST['thanhtoan'])) {
                if ($cardNumber==='' || $cardName==='' || $validDay==='' || $ptvc === '') {
                    $thongbao = "<font color=red size='0.5rem'>Vui lòng nhập đầy đủ thông tin</font>";
                }
                else {
                    function taoMaHD() {
                        GLOBAL $conn;
                
                        $sql = "SELECT MAX(maHD) AS maHD_max FROM hoadon";
                        $result = mysqli_query($conn, $sql);
                        $idMax = mysqli_fetch_assoc($result)["maHD_max"];
                
                        $idHD = intval(substr($idMax, 2)) + 1;
                
                        $HD = str_pad($idHD, 5, "0", STR_PAD_LEFT);
                
                        return "hd" . $HD;
                    }

                    function themHD($maHD, $maND, $maPTVC, $maKM, $ngayDat, $ngayGiao, $tinhTrang, $tongTienHang, $tongThanhToan) {
                        GLOBAL $conn;

                        if ($maKM==null) $txtMaKM = "null";
                        else $txtMaKM = "'$maKM'";
                
                        $sql = "INSERT INTO hoadon(maHD, maND, maPTVC, maKM, ngayDat, ngayGiao, tinhTrang, tongTienHang, tongThanhToan) 
                        VALUES ('$maHD','$maND','$maPTVC',$txtMaKM,'$ngayDat','$ngayGiao',$tinhTrang,'$tongTienHang','$tongThanhToan')";
                        $result = mysqli_query($conn, $sql);

                        return $result;
                    }

                    function themCTHD($maHD, $maTruyen, $soLuong, $donGia) {
                        GLOBAL $conn;
                
                        $sql1 = "INSERT INTO chitiethoadon(maHD, maTruyen, soLuong, donGia) 
                            VALUES ('$maHD', '$maTruyen', '$soLuong', '$donGia')";
                        $result1 = mysqli_query($conn, $sql1);

                        $resultTruyen = mysqli_query($conn, "SELECT * FROM truyen WHERE maTruyen='$maTruyen'");
                        $soLuongTon = mysqli_fetch_assoc($resultTruyen)['soLuongTon'];
                        $newSoLuongTon = $soLuongTon - $soLuong;

                        $sql2 = "UPDATE truyen SET soLuongTon='$newSoLuongTon' WHERE maTruyen='$maTruyen'";
                        $result2 = mysqli_query($conn, $sql2);

                        return $result1 && $result2;
                    }

                    $maHD = taoMaHD();
                    $maPTVC = $ptvc;
                    if ($maKhuyenMai == '') $maKM = null;
                    else $maKM = $maKhuyenMai;
                    $ngayDat = date("Y-m-d");
                    
                    $timeDelivery = 1;
                    switch ($ptvc) {
                        case 'vc001':
                            $timeDelivery = 2;
                            break;
                        case 'vc002':
                            $timeDelivery = 4;
                            break;
                        case 'vc003':
                            $timeDelivery = 10;
                            break;
                        default:
                            break;
                    }
                    $ngayGiao = date('Y-m-d', strtotime("+$timeDelivery days"));
                    $tinhTrang = 0;
                    $tongTienHang = $tongTien;
                    $tongThanhToan = $tongCong;

                    themHD($maHD, $maND, $maPTVC, $maKM, $ngayDat, $ngayGiao, $tinhTrang, $tongTienHang, $tongThanhToan);

                    foreach ($_SESSION['cart'] as $id => $cartItem) {
                        themCTHD($maHD, $id, $cartItem['soLuong'], $cartItem['donGia']);
                    }

                    unset($_SESSION['cart']);
                    echo "<script>alert('Thanh toán thành công');</script>";
                    echo '<script>window.location.href = "../php_customer/thongke_GiaoDich.php";</script>';
                }
            }
        }
        else {
            header('Location: index.php');
        exit();
        }
    } else {
        header('Location: login.php');
        exit();
    }
?>

<main>
    <div align=center><h3>THANH TOÁN</h3></div>
    <div class='info-form'>
        <table>
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
        <p align=center><a class='linkChucNang' href="updateInfo.php">Thay đổi thông tin cá nhân</a></p>
    </div>
    <table id='hd'>
        <tr>
            <th>Tên truyện</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php echo $noidungHD; ?>
    </table>
    <div align=center>
        <form action="" method="post">
            <input id='txtCodeKM' type="text" placeholder="Mã giảm giá" name="code" value="<?php echo $code; ?>">
            <input id='btnUseCode' type="submit" name="useCode" value="Sử dụng">
        </form>
        <p><?php echo $thongbaoCodeKM; ?></p>
    </div>
    <table id='gtDonHang'>
        <tr>
            <td>Tạm tính: </td>
            <td style='float: right;'><?php echo number_format($tongTien, 0, ",", ".")."đ"; ?></td>
        </tr>
        <tr>
            <td>Giảm giá: </td>
            <td style='float: right;'><?php echo $txtGiamGia; ?></td>
        </tr>
        <tr style="border-top: 1px solid gainsboro;">
            <td>Tổng cộng: </td>
            <td style='float: right;'><?php echo number_format($tongCong, 0, ",", ".")."đ"; ?></td>
        </tr>
    </table>
    <form action="" method="post">
        <p align=center style="padding: 1rem;">
            <b>Phương thức vận chuyển: </b>
            <select name="ptvc" >
                <?php
                    $query = "SELECT * FROM ptvanchuyen";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = '';
                        if(isset($_POST['ptvc']) && $_POST['ptvc']==$row['maPTVC']) $selected = 'selected';
                        echo '<option value="' . $row['maPTVC'] . '"'.$selected.'>' . $row['tenPTVC'] . '</option>';
                    }
                ?>
            </select>
        </p>
        <div id='formCC'>
            <h3 align=center>THÔNG TIN THẺ</h3>
            <p align=center><?php echo $thongbao; ?></p>
            <label for="ccnum">Số thẻ</label>
            <input type="text" class='txtCC' name="cardNumber" value="<?php echo $cardNumber; ?>" placeholder="Nhập số thẻ" require>
            <label for="cname">Tên chủ thẻ</label>
            <input type="text" class='txtCC' name="cardName" value="<?php echo $cardName; ?>" placeholder="Nhập tên chủ thẻ" require>
            <label for="expmonth">Ngày phát hành</label>
            <input type="text" class='txtCC' name="validDay" value="<?php echo $validDay; ?>" placeholder="Nhập ngày cấp (MM/YY)" require>
            <input type="hidden" name="tongCong" value="<?php echo $tongCong; ?>">
            <input type="hidden" name="txtGiamGia" value="<?php echo $txtGiamGia; ?>">
            <input type="hidden" name="code" value="<?php echo $code; ?>">
            <input type="hidden" name="maKhuyenMai" value="<?php echo $maKhuyenMai; ?>">
            <input type="submit" id="btnThanhToan" name="thanhtoan" value="Thanh toán">
        </div>
    </form>
</main>

<?php
include('../includes/footer.php');
?>