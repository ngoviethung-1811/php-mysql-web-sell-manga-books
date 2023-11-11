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
function tang($m)
{
	for($i=0;$i<count($m)-1;$i++)
	{
		for($j=$i+1;$j<count($m);$j++)
		{
			if($m[$i]>$m[$j])
			{
				$tam=$m[$i];
				$m[$i]=$m[$j];
				$m[$j]=$tam;
			}
		}
	}
	return $m;
}

function giam($m)
{
	for($i=0;$i<count($m)-1;$i++)
	{
		for($j=$i+1;$j<count($m);$j++)
		{
			if($m[$i]<$m[$j])
			{
				$tam=$m[$i];
				$m[$i]=$m[$j];
				$m[$j]=$tam;
			}
		}
	}
	return $m;
}
?>

<?php 
$mang="";
$mang_giam="";
$mang_tang="";
if(isset($_POST['mang']))
	$mang=$_POST['mang'];
else 
	$mang="";
if(isset($_POST['tinh']) && isset($mang) )
{
	$m=explode(",",$mang);
	$mang_tang=tang($m);
	$mang_tang=implode(",",$mang_tang);
	$mang_giam=giam($m);
	$mang_giam=implode(",",$mang_giam);

}
else
	echo "Hãy nhập dữ liệu vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Sắp xếp</h2></th>

    <tr>

        <td>Nhập mảng:</td>

        <td><input type="text" name="mang" size= "40" value="<?php echo $mang;?> "/></td>

    </tr>
	<tr>

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="sắp xếp tăng/giảm"/></td>

    </tr>
	 <tr>

        <td>Tăng dần:</td>

        <td><input type="textfield" disabled=disable name="mang_tang" size= "40" value="<?php echo $mang_tang;?> "/></td>

    </tr>
	 <tr>

        <td>Giảm dần:</td>

        <td><input type="textfield" disabled=disable name="mang_giam" size= "40" value="<?php echo $mang_giam;?> "/></td>

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
