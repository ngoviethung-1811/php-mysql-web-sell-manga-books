<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<?php

require('QLBanSua_connect.php');

$resHangSua = mysqli_query($conn, "SELECT Ma_hang_sua, Ten_hang_sua FROM hang_sua");
if(mysqli_num_rows($resHangSua)<>0) {
    $inputHangSua = "<select name='hangSua'>";
    while($rows=mysqli_fetch_assoc($resHangSua)){
        $selected = '';
        if(isset($_GET['hangSua']) && $_GET['hangSua']==$rows['Ma_hang_sua']) $selected = 'selected';
        $inputHangSua .= "<option value=${rows['Ma_hang_sua']} ".$selected.">
                ${rows['Ten_hang_sua']}
                </option>";
	}
    $inputHangSua .= "</select>";
}

$resLoaiSua = mysqli_query($conn, "SELECT Ma_loai_sua, Ten_loai FROM loai_sua");
if(mysqli_num_rows($resLoaiSua)<>0) {
    $inputLoaiSua = "<select name='loaiSua'>";
    while($rows=mysqli_fetch_assoc($resLoaiSua)){
        $selected = '';
        if(isset($_GET['loaiSua']) && $_GET['loaiSua']==$rows['Ma_loai_sua']) $selected = 'selected';
        $inputLoaiSua .= "<option value=${rows['Ma_loai_sua']} ".$selected.">
                ${rows['Ten_loai']}
            </option>";
	}
    $inputLoaiSua .= "</select>";
}

?>
<style>
    #tableSua {
        width: 50rem;
        border: 3px solid orange;
    }
    #tableHeader {
        background: #f2e0d8;
        color: #ed5009;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 700;
        height: 2rem;
    }
    td {
        border: 1px solid black;
    }
    #timkiemHeader {
        color: red;
        background: #f2e0d8;
    }
</style>
<form action="" method="get">
    <table bgcolor="#eeeeee" align="center" width="70%" border="1" 
        cellpadding="5" cellspacing="5" style="border-collapse: collapse;">
        <tr>
        <td align="center" id='timkiemHeader'><h3>TÌM KIẾM THÔNG TIN SỮA</h3></td>
        </tr>
        <tr>
        <td align="center">
            Loại sữa: <?php echo $inputLoaiSua; ?> 
            Hãng sữa: <?php echo $inputHangSua; ?>
        </td>
        </tr>
        <tr>
        <td align="center">Tên sữa: <input type="text" name="tensua" size="30" 
        value="<?php if(isset($_GET['tensua'])) echo $_GET['tensua'];?>">
        <input type="submit" name="tim" value="Tìm kiếm"></td>
        </tr>
    </table>
</form>
<?php
$duLieuSua = '';
if($_SERVER['REQUEST_METHOD']=='GET') {
   if(empty($_GET['tensua'])) echo "<p align='center'>Vui lòng nhập tên sản phẩm</p>";
   else {
        $tensua=trim($_GET['tensua']);
        $loaiSua = trim($_GET['loaiSua']);
        $hangSua = trim($_GET['hangSua']);

        $query="Select sua.*, Ten_hang_sua, Ten_loai from sua,hang_sua,loai_sua 
            WHERE sua.Ma_loai_sua=loai_sua.Ma_loai_sua AND sua.Ma_hang_sua=hang_sua.Ma_hang_sua 
            AND sua.Ten_sua like '%$tensua%' AND loai_sua.Ma_loai_sua='$loaiSua'AND hang_sua.Ma_hang_sua='$hangSua'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)<>0) { 
            $rows=mysqli_num_rows($result);
            echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";
            while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $hinh = $row['Hinh'];
            $tenSua = $row['Ten_sua'];
            $tenHangSua = $row['Ten_hang_sua'];
            $trongLuong = $row['Trong_luong'];
            $donGia = $row['Don_gia'];
            $thanhPhan = $row['TP_Dinh_Duong'];
            $loiIch = $row['Loi_ich'];

            $duLieuSua .= "
            <tr>
                        <td id='tableHeader' colspan=2>$tenSua; - $tenHangSua</td>
                    </tr>
                    <tr>
                        <td><img style='width:15rem; height:15rem;' src='./images/Hinh_sua/$hinh' alt='Hinh_sua'></td>
                        <td>
                        <b>Thành phần dinh dưỡng:</b><br>
                        $thanhPhan;<br>
                        <b>Lợi ích:</b><br>
                        $loiIch<br>
                        <span style='float: right;'>
                                <b>Trọng lượng: </b>$trongLuong gr - 
                                <b>Đơn giá: </b>$donGia VNĐ
                        </span>
                        </td>
                    </tr>
            ";
            }
        }
        else echo "<div style='text-align:center;'><b>Không tìm thấy sản phẩm này.</b></div>";
   }
}
?>
<div>
    <table id="tableSua" align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>
        <?php echo $duLieuSua; ?>
    </table>
</div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>