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

$result = mysqli_query($conn, "SELECT Hinh, Ten_sua, Ten_hang_sua, Ten_loai, Trong_luong, Don_gia FROM 
	sua, loai_sua, hang_sua WHERE sua.Ma_loai_sua=loai_sua.Ma_loai_sua AND sua.Ma_hang_sua=hang_sua.Ma_hang_sua");


$numCol = 5;
echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
echo "<tr><td colspan=$numCol><p align='center' style='background: #fae0c5; color: #f74a00; font-weight:900; font-size:30; font-family: Courier New;'>THÔNG TIN CÁC SẢN PHẨM</p></td></tr>";
if(mysqli_num_rows($result)<>0){
	$col = $numCol;
	$row = floor(mysqli_num_rows($result) / $col) + 1;
	for ($i=1; $i <= $row; $i++) {
		$offset =($i-1)*$col;

		echo "<tr align=center>";

		$re = mysqli_query($conn, "SELECT Ma_sua, Hinh, Ten_sua, Ten_hang_sua, Ten_loai, Trong_luong, Don_gia, Ma_sua FROM 
	sua, loai_sua, hang_sua WHERE sua.Ma_loai_sua=loai_sua.Ma_loai_sua AND sua.Ma_hang_sua=hang_sua.Ma_hang_sua LIMIT $offset, $col");

		if (mysqli_num_rows($re)<>0) {
			while($rows=mysqli_fetch_assoc($re)) {
				echo "<td>
					<p><b><a href=./QLBanSua_ThongTinChiTietSua.php?ma_sua=".$rows['Ma_sua'].">${rows['Ten_sua']}</a></b></p><br>
					<p>${rows['Ten_hang_sua']}</p>
					<p>${rows['Trong_luong']} gr - ${rows['Don_gia']} VNĐ</p>
					<p><img style='width:10rem; height:10rem;' src='./images/Hinh_sua/${rows['Hinh']}'/></p>
				</td>";
			}
		}

		echo "</tr>";
	}
}
echo"</table>";
?>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>