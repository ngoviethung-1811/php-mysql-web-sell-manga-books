<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

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

    function taoMaKM() {
        GLOBAL $conn;

        $sql = "SELECT MAX(maKM) AS maKM_max FROM KhuyenMai";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maKM_max"];

        $idTL = intval(substr($idMax, 2)) + 1;

        $TL = str_pad($idTL, 3, "0", STR_PAD_LEFT);

        return "km" . $TL;
    }
    $maKM = taoMaKM();
    $thongbao = '';

    if(isset($_POST['loaiKM']))  
        $loaiKM=trim($_POST['loaiKM']);
    else $loaiKM='';

    if(isset($_POST['giamGia']))  
        $giamGia=trim($_POST['giamGia']); 
    else $giamGia='';

    if(isset($_POST['code']))  
        $code=trim($_POST['code']); 
    else $code='';

    if(isset($_POST['gtDonHang']))  
        $gtDonHang=trim($_POST['gtDonHang']); 
    else $gtDonHang='';

    if(isset($_POST['ngayBD']))  
        $ngayBD=$_POST['ngayBD']; 
    else $ngayBD=date('Y-m-d');

    if(isset($_POST['ngayKT']))  
        $ngayKT=$_POST['ngayKT']; 
    else $ngayKT=date('Y-m-d');

    if(isset($_POST['them']))
    {
        if($maKM == '' || $loaiKM == '' || $code == '' || $giamGia == '' || $gtDonHang == '' || $ngayBD == '' || $ngayKT == '')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else
        {
            $sql = "INSERT INTO khuyenmai (maKM, maLKM, code, giamGia, gtDonHang, ngayBD, ngayKT) 
                VALUES ('$maKM', '$loaiKM', '$code', '$giamGia', '$gtDonHang', '$ngayBD', '$ngayKT')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $maKM = taoMaKM();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }        
    }
?>

<main>
    <p id='pageCaption'>THÊM KHUYẾN MÃI</p>
    <form  action="" method="post">
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
                <td><input type="text" size=40 name="code" value=""/></td>
            </tr>
            <tr>
                <td>Giảm giá:</td>
                <td><input type="number" min="0" size=20 name="giamGia" value=""/></td>
            </tr>
            <tr>
                <td>Giá trị đơn hàng:</td>
                <td><input type="number" min="0" size=20 name="gtDonHang" value=""/></td>
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
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
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