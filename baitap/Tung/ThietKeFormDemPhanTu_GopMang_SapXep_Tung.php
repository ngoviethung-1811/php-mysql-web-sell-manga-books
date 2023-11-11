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
function dem($m)
{
	$dem=0;
	for($i=0;$i<count($m);$i++)
	{
		$dem++;
	}
	return $dem;
}

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
$mang_a="";
$mang_b="";
$so_a="";
$so_b="";
$mang_c="";
$mang_c_tang="";
$mang_c_giam="";
if(isset($_POST['mang_a']))
	$mang_a=$_POST['mang_a'];
else 
	$mang_a="";
if(isset($_POST['mang_b']))
	$mang_b=$_POST['mang_b'];
else 
	$mang_b="";
if(isset($_POST['tinh']) && isset($mang_a) && isset($mang_b)) 
{
	$m_a=explode(",",$mang_a);
	$m_b=explode(",",$mang_b);
	$so_a=dem($m_a);
	$so_b=dem($m_b);
	$mang_c=array_merge($m_a,$m_b);
	$mang_c_tang=tang($mang_c);
	$mang_c_tang=implode(",",$mang_c_tang);
	$mang_c_giam=giam($mang_c);
	$mang_c_giam=implode(",",$mang_c_giam);
	$mang_c=implode(",",$mang_c);

}
else
	echo "Hãy nhập dữ liệu vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Đếm phần tử, Ghép mảng và Sắp xếp</h2></th>

    <tr>

        <td>Nhập mảng a:</td>

        <td><input type="text" name="mang_a" size= "40" value="<?php echo $mang_a;?> "/></td>

    </tr>
	<tr>

        <td>Nhập mảng b:</td>

        <td><input type="text" name="mang_b" size= "40" value="<?php echo $mang_b;?> "/></td>

    </tr>
	<tr>

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="Thực hiện"/></td>

    </tr>
	<tr>

        <td>Số phần tử mảng a:</td>

        <td><input type="textfield" disabled=disable name="so_a" size= "10" value="<?php echo $so_a;?> "/></td>

    </tr>
	<tr>

        <td>Số phần tử mảng b:</td>

        <td><input type="textfield" disabled=disable name="so_b" size= "10" value="<?php echo $so_b;?> "/></td>

    </tr>
	<tr>

        <td>Mảng c:</td>

        <td><input type="textfield" disabled=disable name="mang_c" size= "40" value="<?php echo $mang_c;?> "/></td>
   </tr>
    <tr>

        <td>Mảng c tăng dần:</td>

        <td><input type="textfield" disabled=disable name="mang_c_tang" size= "40" value="<?php echo $mang_c_tang;?> "/></td>

    </tr>
	<tr>

        <td>Mảng c giảm dần:</td>

        <td><input type="textfield" disabled=disable name="mang_c_giam" size= "40" value="<?php echo $mang_c_giam;?> "/></td>

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

