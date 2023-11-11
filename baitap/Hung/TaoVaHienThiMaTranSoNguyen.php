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
	if(isset($_POST['m'])) $m=trim($_POST['m']);
	else $m=0;
	if(isset($_POST['n'])) $n=trim($_POST['n']);
	else $n=0;
	if(isset($_POST['ketqua'])) $ketqua=$_POST['ketqua'];
	else $ketqua='';

	function tao_ma_tran($d, $c) {
		$matrix = array();
		for ($i = 0; $i < $d; $i++) {
			$matrix[$i] = array();
			for ($j = 0; $j < $c; $j++) {
				$matrix[$i][$j] = rand(-1000, 1000);
			}
		}
		return $matrix;
	}

	function hien_thi_PT_dongC_cotL($arr) {
		$d = count($arr);
		$c = count($arr[0]);
		$str = '';
		for ($i = 0; $i < $d; $i++) {
			for ($j = 0; $j < $c; $j++) {
				if ($i % 2 == 0 && $j % 2 != 0)
					$str .= $arr[$i][$j] . " ";
			}
		}
		return $str;
	}

	function tinh_tong_PT_boi10($arr) {
		$d = count($arr);
		$c = count($arr[0]);
		$sum = 0;
		for ($i = 0; $i < $d; $i++) {
			for ($j = 0; $j < $c; $j++) {
				if ($arr[$i][$j] % 10 == 0)
					$sum += $arr[$i][$j];
			}
		}
		return $sum;
	}

	if(isset($_POST['xuly'])) {
		if ($m < 2 || $m > 5 || $n < 2 || $n > 5) {
			echo "<font color='red'>Vui lòng nhập m, n từ 2 đến 5!</font>";
			$ketqua = '';
		}
		else {
			$mang = tao_ma_tran($m, $n);

			$ketqua = "Ma trận được tạo ra: \n";
			for ($i = 0; $i < $m; $i++) {
				for ($j = 0; $j < $n; $j++)
					$ketqua .= $mang[$i][$j] . " ";
				$ketqua .= "\n";
			}

			$ketqua .= "\nCác phần tử thuộc dòng chẵn cột lẻ: " . hien_thi_PT_dongC_cotL($mang);
			$ketqua .= "\nTổng các phần tử là bội số của 10: " . tinh_tong_PT_boi10($mang);
		}
	}
	else {
		$ketqua = '';
	}
?>
<form action="" method="post">
	<table>
		<tr>
			<td>Nhập m (2-5): </td>
			<td><input type="number" name="m" value="<?php echo $m?>"/></td>
		</tr>
		<tr>
			<td>Nhập n (2-5): </td>
			<td><input type="number" name="n" value="<?php echo $n?>"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="xuly" value="Xử lý"/></td>
		</tr>
		<tr>
			<td colspan="2">
				<textarea cols="50" rows="10" name="ketqua"> <?php echo $ketqua?></textarea>
			</td>
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