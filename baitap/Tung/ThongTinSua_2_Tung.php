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

$result = mysqli_query($conn, 'select Ten_hang_sua,Ten_sua,Trong_luong,Don_gia,Hinh from sua,hang_sua,loai_sua where sua.Ma_hang_sua = hang_sua.Ma_hang_sua and sua.Ma_loai_sua = loai_sua.Ma_loai_sua');



echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SỮA</font></P>";

 echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

 echo '<tr>

    <th width="350">Thông tin sữa</th>


</tr>';



 if(mysqli_num_rows($result)<>0)

 {	

	while($rows=mysqli_fetch_row($result))

	{       echo "<tr>";

		    echo '<td><img width="100px" height="100px" src="Hinh_sua/'.$rows[4] .'" /></td>';

		    echo "<td>
					<h3>$rows[1]</h3>
					<p>Nha sản xuất:$rows[0]</p>
					<p>$rows[2] g-$rows[3] VNĐ</p>
				</td>";

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