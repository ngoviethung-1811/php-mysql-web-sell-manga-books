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
function taomang($n)
{
	$mang=array();
	for($i=0;$i<$n;$i++)
	{
		$mang[$i]=rand(0,20);
	}
	return $mang;
}

function tongmang($m)
{
	$tong=0;
	for($i=0;$i<count($m);$i++)
	{
		$tong+=$m[$i];
	}
	return $tong;
}

function timmax($m)
{
	$max=$m[0];
	for($i=1;$i<count($m);$i++)
	{
		if($max<$m[$i])
		{
			$max=$m[$i];
		}
	}
	return $max;
}

function timmin($m)
{
	$min=$m[0];
	for($i=1;$i<count($m);$i++)
	{
		if($min>$m[$i])
		{
			$min=$m[$i];
		}
	}
	return $min;
}
?>

<?php 
$n="";
$mang="";
$tong="";
$max="";
$min="";
if(isset($_POST['n']))
	$n=$_POST['n'];
else 
	$n="";
if(isset($_POST['tinh']) && is_numeric($n))
{
	$mang=taomang($n);
	$tong=tongmang($mang);
	$max=timmax($mang);
	$min=timmin($mang);
	$mang=implode(" ", $mang);
	
}
else
	echo "Hãy nhập số vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Phát sinh mảng</h2></th>

    <tr>

        <td>Nhập số phần tử:</td>

        <td><input type="text" name="n" size= "10" value="<?php echo $n;?> "/></td>

    </tr>
	<tr>

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="Phát sinh mảng"/></td>

    </tr>
	<tr>

        <td>Mảng:</td>

        <td><input type="textfield" disabled=disable name="n" size= "40" value="<?php echo $mang;?> "/></td>

    </tr>
	<tr>

        <td>GTLN (Max) trong mảng:</td>

        <td><input type="textfield" disabled=disable name="n" size= "10" value="<?php echo $max;?> "/></td>

    </tr>
	<tr>

        <td>GTNN (Min) trong mảng:</td>

        <td><input type="textfield" disabled=disable name="n" size= "10" value="<?php echo $min;?> "/></td>

    </tr>
	<tr>

        <td>Tổng mảng:</td>

         <td><input type="textfield" disabled=disable name="n" size= "10" value="<?php echo $tong;?> "/></td>

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


