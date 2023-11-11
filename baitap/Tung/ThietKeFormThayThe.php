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
function thaythe($mang,$canthay,$thay)
{
	for($i=0;$i<count($mang);$i++)
	{
		if($mang[$i]==$canthay)
		{
			$mang[$i]=$thay;
		}
	}
	return $mang;
}

?>

<?php 
$mang_cu="";
$mang_moi="";
$tim="";
$thay="";
if(isset($_POST['mang']))
	$mang_cu=$_POST['mang'];
else 
	$mang_cu="";
if(isset($_POST['tim']))
	$tim=$_POST['tim'];
else 
	$tim="";
if(isset($_POST['thay']))
	$thay=$_POST['thay'];
else 
	$thay="";
if(isset($_POST['tinh']) && isset($mang_cu) && is_numeric($tim) && is_numeric($thay))
{
	$m=explode(",",$mang_cu);
	$mang_moi=thaythe($m,$tim,$thay);
	$mang_moi=implode(",",$mang_moi);
	
}
else
	echo "Hãy nhập dữ liệu vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Thay thế</h2></th>

    <tr>

        <td>Nhập mảng:</td>

        <td><input type="text" name="mang" size= "40" value="<?php echo $mang_cu;?> "/></td>

    </tr>
	<tr>

        <td>Giá trị cần thay thế:</td>

        <td><input type="text" name="tim" size= "10" value="<?php echo $tim;?> "/></td>

    </tr>
	<tr>

        <td>Giá trị thay thế:</td>

        <td><input type="text" name="thay" size= "10" value="<?php echo $thay;?> "/></td>

    </tr>
	<tr>

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="Thay thế"/></td>

    </tr>
	<tr>

        <td>Mảng cũ:</td>

        <td><input type="textfield" disabled=disable name="n" size= "40" value="<?php echo $mang_cu;?> "/></td>

    </tr>
	<<tr>

        <td>Mảng sau khi thay:</td>

        <td><input type="textfield" disabled=disable name="n" size= "40" value="<?php echo $mang_moi;?> "/></td>

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
