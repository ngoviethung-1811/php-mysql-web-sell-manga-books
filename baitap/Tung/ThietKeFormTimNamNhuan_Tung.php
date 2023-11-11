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
function namnhuan($year)
{
	if(($year%400==0) || ($year%4==0 && $year%100!=0))
		return true;
	else 
		return false;
}
?>

<?php 
$kq="";
if(isset($_POST['nam']))
	$nam=$_POST['nam'];
else 
	$nam="";
if(isset($_POST['tinh']) && is_numeric($nam))
{
	$str="";
	foreach(range(2000,$nam) as $year)
		{
			if(namnhuan($year))
			{
				$str.=" ".$year;
			}
		}
	if($str!="")
	{
		$kq=$str;
	}
	else
		$kq="Không có năm nhuận";
}
else
	echo "Hãy nhập số vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Tìm năm nhuận</h2></th>

    <tr>

        <td>Nhập năm:</td>

        <td><input type="text" name="nam" size= "70" value="<?php echo $nam;?> "/></td>

    </tr>
	<tr>
		<td colspan="2"><textarea name="ketqua" cols="75" rows="1"><?php echo "$kq"; ?></textarea></td>
	</tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" name="tinh"  size="20" value="Tìm năm nhuận"/></td>
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




