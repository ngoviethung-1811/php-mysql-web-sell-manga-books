<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<style>
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
    require("connect.php");

    if (isset($_GET['id'])) {
        $maKM = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat']))
        {
            $loaiKM = trim($_POST['loaiKM']);
            $code = trim($_POST['code']);
            $giamGia = trim($_POST['giamGia']);
            $gtDonHang = trim($_POST['gtDonHang']);
            $ngayBD = trim($_POST['ngayBD']);
            $ngayKT = trim($_POST['ngayKT']);

            $sql = "UPDATE khuyenmai SET maLKM='$loaiKM', code='$code', giamGia='$giamGia', 
                gtDonHang='$gtDonHang', ngayBD='$ngayBD', ngayKT='$ngayKT' WHERE maKM='$maKM'";
            $result = mysqli_query($conn, $sql);
            if ($result)
            {
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * FROM khuyenmai WHERE maKM='$maKM'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $loaiKM = $row['maLKM'];
            $code = $row['code'];
            $giamGia = $row['giamGia'];
            $gtDonHang = $row['gtDonHang'];
            $ngayBD = $row['ngayBD'];
            $ngayKT = $row['ngayKT'];
        }
        else {
            $loaiKM = '';
            $code = '';
            $giamGia = '';
            $gtDonHang = '';
            $ngayBD = '';
            $ngayKT = '';
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA KHUYẾN MÃI</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã khuyến mãi:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maKM" value="<?php echo $maKM; ?>"/></td>
            </tr>
            <tr>
                <td>Loại khuyến mãi:</td>
                <td>
                    <select name="loaiKM" >
                        <?php
                            $query = "SELECT * FROM loaikhuyenmai";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['maLKM'] . '">' . $row['tenLKM'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Code:</td>
                <td><input type="text" size=40 name="code" value="<?php echo $code ?>"/></td>
            </tr>
            <tr>
                <td>Giảm giá:</td>
                <td><input type="number" min="0" size=20 name="giamGia" value="<?php echo $giamGia ?>"/></td>
            </tr>
            <tr>
                <td>Giá trị đơn hàng:</td>
                <td><input type="number" min="0" size=20 name="gtDonHang" value="<?php echo $gtDonHang ?>"/></td>
            </tr>
            <tr>
                <td>Ngày bắt đầu:</td>
                <td><input type="date" name="ngayBD" value="<?php echo $ngayBD; ?>"/></td>
            </tr>
            <tr>
                <td>Ngày kết thúc:</td>
                <td><input type="date" name="ngayKT" value="<?php echo $ngayKT; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
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