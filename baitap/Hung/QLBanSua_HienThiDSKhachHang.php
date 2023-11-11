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

$sql = 'select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_thoai,Email from khach_hang';
$result = mysqli_query($conn, $sql);

echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>";
echo "<table align='center' width='900' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
echo '<tr>
    <th width="100" style="color:red;">Mã KH</th>
    <th width="200" style="color:red;">Tên khách hàng</th>
    <th width="100" style="color:red;">Giới tính</th>
    <th width="300" style="color:red;">Địa chỉ</th>
    <th width="150" style="color:red;">Số điện thoại</th>
    <th width="150" style="color:red;">Email</th>
    <th style="color:red;">!</th>
    <th style="color:red;">X</th>
</tr>';
if(mysqli_num_rows($result)<>0) {
	$stt=1;
	while($rows=mysqli_fetch_row($result)) {
		if ($stt%2!=0) echo "<tr style='background-color: #b9e7f0;'>";
		else echo "<tr>";

  	echo "<td>$rows[0]</td>";
  	echo "<td>$rows[1]</td>";
  	
  	if ($rows[2]==0) echo "<td align='center'><img width=50 src='https://i.pinimg.com/564x/24/7d/0b/247d0bb6798db9fa93914fbe443da86e.jpg'/></td>";
  	else echo "<td align='center'><img width=50 src='https://i.pinimg.com/736x/e7/c6/49/e7c64915a30298ac7734b8a05da743a7.jpg'/></td>";

  	echo "<td>$rows[3]</td>";
  	echo "<td>$rows[4]</td>";
  	echo "<td>$rows[5]</td>";
  	echo "<td><a href=./QLBanSua_CapNhatTTKhachHang.php?ma_kh=".$rows[0].">Sửa</a></td>";
  	echo "<td><a href=./QLBanSua_XoaKhachHang.php?ma_kh=".$rows[0].">Xoá</a></td>";
  	echo "</tr>";

  	$stt++;
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