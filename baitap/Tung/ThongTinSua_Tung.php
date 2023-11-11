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
// Ket noi CSDL
//require("connect.php");

$conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 

		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

mysqli_set_charset($conn, 'UTF8');	

$rowsPerPage=10;
if(!isset($_GET['page']))	
{
	$_GET['page']=1;
}
$offSet=($_GET['page']-1)*$rowsPerPage;

$result = mysqli_query($conn, 'select Ma_sua,Ten_sua,Trong_luong,Don_gia from sua LIMIT ' . $offSet . ',' . $rowsPerPage);



echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SỮA</font></P>";

echo '<a href="ThemMoiSua_Tung.php">Thêm mới</a>';

 echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

 echo '<tr>

    <th width="50">STT</th>

     <th width="50">Mã sữa</th>

    <th width="350">Tên sữa</th>

    <th width="100">Trọng lượng</th>
	
	<th width="100">Đơn giá</th>

</tr>';



 if(mysqli_num_rows($result)<>0)

 {	 $stt=1;

	while($rows=mysqli_fetch_row($result))

	{          echo "<tr>";

		     echo "<td>$stt</td>";

		     echo "<td>$rows[0]</td>";

		     echo "<td>$rows[1]</td>";

		     echo "<td>$rows[2]</td>";
			 
			 echo "<td>$rows[3]</td>";

		     echo "</tr>";

	             $stt+=1;

	}

 }

echo"</table>";

$re = mysqli_query($conn, 'select * from sua');
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re); 
//tổng số trang
$maxPage = floor($numRows/$rowsPerPage) + 1; 

echo "<br>";
echo '<div align="center">';
//gắn thêm nút Back
if ($_GET['page'] > 1)
{ 
	echo "<a href=" .$_SERVER['PHP_SELF']."?page=1"."><<</a> ";//nut ve dau trang
	echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."><</a> "; 
}

//tạo link tương ứng tới các trang
for ($i=1 ; $i<=$maxPage ; $i++) //tạo link tương ứng tới các trang
{
	if ($i == $_GET['page'])
		echo '<b> '. $i. '</b> '; //trang hiện tại sẽ được bôi đậm
	else
		echo "<a href=" .$_SERVER['PHP_SELF']."?page=".$i.">".$i."</a> ";
}
//gắn thêm nút Next
if ($_GET['page'] < $maxPage)
{ 
	echo "<a href = ". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1).">></a>";
	echo "<a href = ". $_SERVER['PHP_SELF']."?page=".$maxPage.">>></a>";//nut ve cuoi trang
}
echo '</div>';
echo '<p align="center">Tong so trang la:'.$maxPage .'</p>';

?>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>