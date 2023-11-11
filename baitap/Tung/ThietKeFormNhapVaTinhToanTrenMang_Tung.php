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
function tongmang($m)
{
	$tong=0;
	for($i=0;$i<count($m);$i++)
	{
		$tong+=$m[$i];
	}
	return $tong;
}

?>

<?php 
$tong="";
if(isset($_POST['mang']))
	$mang=$_POST['mang'];
else 
	$mang="";
if(isset($_POST['tinh']) && isset($mang) )
{
	$m=explode(",",$mang);
	$tong=tongmang($m);
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

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="Tổng dãy số"/></td>

    </tr>
	<tr>

        <td>Tổng dãy số:</td>

        <td><input type="textfield" disabled=disable name="n" size= "20" value="<?php echo $tong;?> "/></td>

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
