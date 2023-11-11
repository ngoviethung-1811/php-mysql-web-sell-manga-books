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
function timkiem($m,$n)
{
	for($i=0;$i<$m;$i++)
	{
		if($m[$i]==$n)
		{
			return "Tìm thấy $n ở vị trí thứ".$i+1;
		}
	}
	return "Không tìm thấy $n trong mảng";
}

?>

<?php 
$kq="";
$mang="";
$n="";
if(isset($_POST['mang']))
	$mang=$_POST['mang'];
else 
	$mang="";
if(isset($_POST['n']))
	$n=$_POST['n'];
else 
	$n="";
if(isset($_POST['tinh']) && isset($mang) && is_numeric($n))
{
	$m=explode(",",$mang);
	$kq=timkiem($m,$n);
}
else
	echo "Hãy nhập dữ liệu vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Tìm kiếm</h2></th>

    <tr>

        <td>Nhập mảng:</td>

        <td><input type="text" name="mang" size= "40" value="<?php echo $mang;?> "/></td>

    </tr>
	<tr>

        <td>Nhập số cần tìm:</td>

        <td><input type="text" name="n" size= "10" value="<?php echo $n;?> "/></td>

    </tr>
	<tr>

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="TÌm kiếm"/></td>

    </tr>
	<tr>

        <td>Mảng:</td>

        <td><input type="textfield" disabled=disable name="n" size= "40" value="<?php echo $mang;?> "/></td>

    </tr>
	<tr>

        <td>Kết quả tìm kiếm:</td>

        <td><input type="textfield" disabled=disable name="n" size= "30" value="<?php echo $kq;?> "/></td>

    </tr>
</table>

</form>



</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>