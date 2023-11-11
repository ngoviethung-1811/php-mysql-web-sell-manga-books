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
require("QLBanSua_connect.php");

$rowsPerPage=2;
if (!isset($_GET['page'])) $_GET['page'] = 1;
$offset =($_GET['page']-1)*$rowsPerPage;
$result = mysqli_query($conn, "SELECT Ma_sua, Hinh, Ten_sua, Ten_hang_sua, Ten_loai, Trong_luong, Don_gia, TP_Dinh_Duong, Loi_ich FROM 
sua, loai_sua, hang_sua WHERE sua.Ma_loai_sua=loai_sua.Ma_loai_sua AND sua.Ma_hang_sua=hang_sua.Ma_hang_sua
LIMIT $offset, $rowsPerPage");

$duLieuSua = "";

if(mysqli_num_rows($result)<>0){
	while($rows=mysqli_fetch_assoc($result)){
        $hinh = $rows['Hinh'];
        $tenSua = $rows['Ten_sua'];
        $tenHangSua = $rows['Ten_hang_sua'];
        $tenLoaiSua = $rows['Ten_loai'];
        $trongLuong = $rows['Trong_luong'];
        $donGia = $rows['Don_gia'];
        $thanhPhan = $rows['TP_Dinh_Duong'];
        $loiIch = $rows['Loi_ich'];

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

$re = mysqli_query($conn, 'select * from sua');
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re);
//tổng số trang
$maxPage = floor($numRows/$rowsPerPage) + 1;

$phanTrang = "";

$phanTrang .= "<p align=center>";
if ($_GET['page'] > 1) {
	$phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=1> << </a> ";
	$phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a> ";
}
for ($i=1 ; $i<=$maxPage ; $i++){ 
	if ($i == $_GET['page'])
        $phanTrang .= '<b>'.$i.'</b> '; //trang hiện tại sẽ được bôi đậm
	else
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">".$i."</a> ";
}
if ($_GET['page'] < $maxPage) {
	$phanTrang .= "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
	$phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a> ";
}
$phanTrang .= "</p>";
?>

<style>
    table {
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
</style>
<p align='center'><font size='5' color=red> THÔNG TIN CHI TIẾT CÁC LOẠI SỮA</font></p>
<div>
    <table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>
        <?php echo $duLieuSua; ?>
    </table>
    <?php echo $phanTrang; ?>
</div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>