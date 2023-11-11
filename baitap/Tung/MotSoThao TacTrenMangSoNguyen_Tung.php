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
function hienthimang($a)
{
	for($i=0;$i<count($a);$i++)
	{
		echo "   $a[$i];";
	}
	echo "<br>";
}
function demsochan($a)
{
	$dem=0;
	for($i=0;$i<count($a);$i++)
	{
		if($a[$i]%2==0)
		{
			$dem++;
		}
	}
	return $dem;
}
function demsonhohon100($a)
{
	$dem=0;
	for($i=0;$i<count($a);$i++)
	{
		if($a[$i]<100)
		{
			$dem++;
		}
	}
	return $dem;
}
function taomang($n)
{
	$a=array();
	for($i=0;$i<$n;$i++)
	{
		$a[$i]=rand(-1000,1000);
	}
	return $a;
}

function tongam($a)
{
	$tong=0;
	for($i=0;$i<count($a);$i++)
	{
		if($a[$i]<0)
		{
			$tong +=$a[$i];
		}
	}
	return $tong;
}

function vitrisokecuoila0($a)
{
	$b=array();
	for($i=0;$i<count($a);$i++)
	{
		if(($a[$i]/10)%10==0)
		{
			$vitri=$i+1;
			$b[$i]=$vitri;
		}
	}
	if(count($b)>=1)
		return $b;
	else
		return $b=array("Không có số nào có số kề cuối là 0");
}

function sapxeptangdan($a)
{
	for($i=0;$i<count($a)-1;$i++)
	{
		for($j=$i+1;$j<count($a);$j++)
		{
			if($a[$i]>$a[$j])
			{
				$tam=$a[$i];
				$a[$i]=$a[$j];
				$a[$j]=$tam;
			}
		}
	}
	return $a;
	
}

?>

<?php 
$kq="";
if(isset($_POST['n']))
	$n=$_POST['n'];
else 
	$n=0;
if(isset($_POST['tinh']) && $n>0 && is_numeric($n))
{
	$a=taomang($n);
	$str=implode(" ", $a);
	$kq="Mảng được tạo là: ".$str;
	$kq.="\nSố phần tử chẵn là: ";
	$kq.=demsochan($a);
	$kq.="\nSố phần tử nhỏ hơn 100 là: ";
	$kq.=demsonhohon100($a);
	$kq.="\nTổng các phần tử âm là: ";
	$kq.=tongam($a);
	$b=vitrisokecuoila0($a);
	$str2=implode(" ",$b);
	$kq.="\nVị trí các phần tử có số kề cuối là 0: ".$str2;
	$c=sapxeptangdan($a);
	$str3=implode(" ",$c);
	$kq.="\nMảng sau khi sắp xếp tăng dần là: ".$str3;
}
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Một số thao tác trên mảng</h2></th>

    <tr>

        <td>Nhập n:</td>

        <td><input type="text" name="n" size= "70" value="<?php echo $n;?> "/></td>

    </tr>

    <tr>

        <td></td>

        <td colspan="2" align="center"><input type="submit" name="tinh"  size="20" value="Xử lý"/></td>

    </tr>
	<tr>
		<td colspan="2"><textarea name="ketqua" cols="70" rows="10"><?php echo "$kq"; ?></textarea></td>
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


