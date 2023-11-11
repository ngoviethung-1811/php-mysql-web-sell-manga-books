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
	if (isset($_POST['tu1']))
		$tu1 = trim($_POST['tu1']);
	else $tu1 = 0;
	if (isset($_POST['mau1']))
		$mau1 = trim($_POST['mau1']);
	else $mau1 = 0;
	if (isset($_POST['tu2']))
		$tu2 = trim($_POST['tu2']);
	else $tu2 = 0;
	if (isset($_POST['mau2']))
		$mau2 = trim($_POST['mau2']);
	else $mau2 = 0;
	if (isset($_POST['radPT']))
		$radPT = trim($_POST['radPT']);
	else $radPT = '';
	$ketqua = '';

	class PhanSo {
		private $tu, $mau;

		public function __construct($tu, $mau) {
			$this->tu = $tu;
			$this->mau = $mau;
		}

		public function __toString() {
	        return "$this->tu/$this->mau";
	    }

	    public function getTu() {
	    	return $this->tu;
	    }

	    public function setTu($tu) {
	    	$this->tu = $tu;
	    }

	    public function getMau() {
	    	return $this->mau;
	    }

	    public function setMau($mau) {
	    	$this->mau = $mau;
	    }

	    public static function UCLN($a, $b) {
		    if ($b == 0) return $a;
		    return self::UCLN($b, $a % $b);
		}

		public static function rutgon(PhanSo $p) {
			if ($p->getTu() % $p->getMau() == 0) return $p->getTu() / $p->getMau();
			$tsChung = self::UCLN($p->getTu(), $p->getMau());
			return new PhanSo($p->getTu()/$tsChung, $p->getMau()/$tsChung);
		}

		public function cong(PhanSo $p) {
			$tuSo = $this->tu * $p->mau + $p->tu * $this->mau;
			$mauSo = $this->mau * $p->mau;
			$kq = new PhanSo($tuSo, $mauSo);
			return self::rutgon($kq);
		}

		public function tru(PhanSo $p) {
			$tuSo = $this->tu * $p->mau - $p->tu * $this->mau;
			$mauSo = $this->mau * $p->mau;
			$kq = new PhanSo($tuSo, $mauSo);
			return self::rutgon($kq);
		}

		public function nhan(PhanSo $p) {
			$tuSo = $this->tu * $p->tu;
			$mauSo = $this->mau * $p->mau;
			$kq = new PhanSo($tuSo, $mauSo);
			return self::rutgon($kq);
		}

		public function chia(PhanSo $p) {
			$tuSo = $this->tu * $p->mau;
			$mauSo = $this->mau * $p->tu;
			$kq = new PhanSo($tuSo, $mauSo);
			return self::rutgon($kq);
		}
	}

	if (isset($_POST['tinh'])) {
		if (is_numeric($tu1) && is_numeric($mau1) && is_numeric($tu2) && is_numeric($mau2)) {
			if ($mau1 == 0 || $mau2 == 0) {
				echo "<font color='red'>Vui lòng nhập mẫu khác 0!</font>";
				$ketqua = '';
			}
			else {
				$p1 = new PhanSo($tu1, $mau1);
				$p2 = new PhanSo($tu2, $mau2);
				switch ($radPT) {
					case 'cong':
						$ketqua = "$p1 + $p2 = " . $p1->cong($p2);
						break;
					case 'tru':
						$ketqua = "$p1 - $p2 = " . $p1->tru($p2);
						break;
					case 'nhan':
						$ketqua = "$p1 x $p2 = " . $p1->nhan($p2);
						break;
					case 'chia':
						$ketqua = "$p1 : $p2 = " . $p1->chia($p2);
						break;					
					default:
						break;
				}
			}
		}
		else {
			echo "<font color='red'>Vui lòng nhập vào số!</font>";
			$ketqua = '';
		}
	}
	else
		$ketqua='';
?>
<form action="" method="post">
	<h4 style="color: purple;">Chọn các phép tính trên phân số</h4>
	Nhập phân số thứ 1: Tử số: <input type="text" name="tu1" size="10" value="<?php echo $tu1; ?>"> Mẫu số <input type="text" name="mau1" size="10" value="<?php echo $mau1; ?>">
	<br>Nhập phân số thứ 2: Tử số: <input type="text" name="tu2" size="10" value="<?php echo $tu2; ?>"> Mẫu số <input type="text" name="mau2" size="10" value="<?php echo $mau2; ?>">
	<fieldset>
		<legend>Chọn phép tính</legend>
		<input type="radio" name="radPT" value="cong" <?php if(isset($_POST['radPT'])&&$_POST['radPT']=='cong') echo 'checked="checked"';?> checked> Cộng
		<input type="radio" name="radPT" value="tru" <?php if(isset($_POST['radPT'])&&$_POST['radPT']=='tru') echo 'checked="checked"';?> > Trừ
		<input type="radio" name="radPT" value="nhan" <?php if(isset($_POST['radPT'])&&$_POST['radPT']=='nhan') echo 'checked="checked"';?> > Nhân
		<input type="radio" name="radPT" value="chia" <?php if(isset($_POST['radPT'])&&$_POST['radPT']=='chia') echo 'checked="checked"';?> > Chia
	</fieldset>
	<br><input type="submit" name="tinh" value="Kết quả"><br>
	<?php echo $ketqua; ?>
</form>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>