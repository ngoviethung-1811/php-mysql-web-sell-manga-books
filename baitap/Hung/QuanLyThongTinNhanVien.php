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
abstract class NhanVien {
	protected $hoTen;
	protected $gioiTinh;
	protected $ngaySinh;
	protected $ngayVaoLam;
	protected $heSoLuong;
	protected $soCon;
	protected const LUONGCB = 1500000;

	public function __construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon) {
		$this->hoTen = $hoTen;
		$this->gioiTinh = $gioiTinh;
		$this->ngaySinh = $ngaySinh;
		$this->ngayVaoLam = $ngayVaoLam;
		$this->heSoLuong = $heSoLuong;
		$this->soCon = $soCon;
	}

	public abstract function tinhTienLuong();
	public abstract function tinhTroCap();

	public function tinhTienThuong() {
		$nvl = explode("/", $this->ngayVaoLam);
		$soNamLam = date("Y") - $nvl[2];
		return $soNamLam * 1000000;
	}
}

class NhanVienVP extends NhanVien {
	private $soNgayVang;
	private const DINHMUCVANG = 30;
	private const DONGIAPHAT = 100000;

	public function __construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang) {
		parent::__construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon);
		$this->soNgayVang = $soNgayVang;
	}

	public function tinhTienLuong()	{
		return self::LUONGCB * $this->heSoLuong - $this->tinhTienPhat();
	}

	public function tinhTroCap() {
		if ($this->gioiTinh == "nu")
			return 200000 * $this->soCon * 1.5;
		else
			return 200000 * $this->soCon;
	}

	public function tinhTienPhat() {
		if ($this->soNgayVang > self::DINHMUCVANG)
			return $this->soNgayVang * self::DONGIAPHAT;
		return 0;
	}
}

class NhanVienSX extends NhanVien {
	private $soSP;
	private const DINHMUCSP = 50;
	private const DONGIASP = 100000;

	public function __construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon, $soSP) {
		parent::__construct($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon);
		$this->soSP = $soSP;
	}

	public function tinhTienLuong()	{
		return ($this->soSP * self::DONGIASP) + $this->tinhTienThuong();
	}

	public function tinhTroCap() {
		return $this->soCon * 120000;
	}

	public function tinhTienThuong() {
		if ($this->soSP > self::DINHMUCSP)
			return ($this->soSP - self::DINHMUCSP) * self::DONGIASP * 0.03;
		return 0;
	}
}

if (isset($_POST['hoTen']))
	$hoTen = trim($_POST['hoTen']);
else $hoTen = "";
if (isset($_POST['soCon']))
	$soCon = trim($_POST['soCon']);
else $soCon = "";
if (isset($_POST['ngaySinh']))
	$ngaySinh = $_POST['ngaySinh'];
else $ngaySinh = "";
if (isset($_POST['ngayVaoLam']))
	$ngayVaoLam = $_POST['ngayVaoLam'];
else $ngayVaoLam = "";
if (isset($_POST['radGT']))
	$gioiTinh = trim($_POST['radGT']);
else $gioiTinh = "";
if (isset($_POST['heSoLuong']))
	$heSoLuong = trim($_POST['heSoLuong']);
else $heSoLuong = "";
if (isset($_POST['radNV']))
	$loaiNV = trim($_POST['radNV']);
else $loaiNV = "";
if (isset($_POST['soNgayVang']))
	$soNgayVang = trim($_POST['soNgayVang']);
else $soNgayVang = "";
if (isset($_POST['soSP']))
	$soSP = trim($_POST['soSP']);
else $soSP = "";

if (isset($_POST['tinh'])) {
	if ($hoTen=="" || $soCon=="" || $ngaySinh=="" || $ngayVaoLam=="" || $heSoLuong=="") {
		$thongBao = "<font color='red'>Vui lòng nhập đầy đủ thông tin!</font>";
		$tienLuong = "";
		$troCap = "";
		$tienThuong = "";
		$tienPhat = "";
		$thucLinh = "";
	}
	else {
		if (($loaiNV=="vp" && $soNgayVang=="") || ($loaiNV=="sx" && $soSP=="")) {
			$thongBao = "<font color='red'>Vui lòng nhập đầy đủ thông tin!</font>";
			$tienLuong = "";
			$troCap = "";
			$tienThuong = "";
			$tienPhat = "";
			$thucLinh = "";
		}
		else {
			$thongBao = "";

			if ($loaiNV == "vp")
				$nv = new NhanVienVP($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang);
			else
				$nv = new NhanVienSX($hoTen, $gioiTinh, $ngaySinh, $ngayVaoLam, $heSoLuong, $soCon, $soSP);

			$tienLuong = $nv->tinhTienLuong();
			$troCap = $nv->tinhTroCap();
			$tienThuong = $nv->tinhTienThuong();
			if ($loaiNV == "vp")
				$tienPhat = $nv->tinhTienPhat();
			else $tienPhat = 0;

			$thucLinh = $tienLuong + $troCap + $tienThuong - $tienPhat;
		}
	}
}
else {
	$thongBao = "";
	$tienLuong = "";
	$troCap = "";
	$tienThuong = "";
	$tienPhat = "";
	$thucLinh = "";
}
?>

<style>
	table {
	margin: 0 auto;
	}
	#tablehead {
		text-align: center;
		font-weight: 800;
	}
	.info {
		background: lightyellow;
	}
</style>
<form action="" method="POST">
	<table>
		<thead>
			<th colspan="4" id="tablehead">QUẢN LÝ NHÂN VIÊN</th>
		</thead>
		<tr>
			<td class="info">Họ và tên:</td>
			<td class="info"><input size="40" type="text" name="hoTen" value="<?php  echo $hoTen;?>" /></td>
			<td class="info">Số con:</td>
			<td class="info"><input size="10" type="text" name="soCon" value="<?php  echo $soCon;?>" /></td>
		</tr>
		<tr>
			<td class="info">Ngày sinh:</td>
			<td class="info"><input size="20" type="text" name="ngaySinh" value="<?php  echo $ngaySinh;?>" /></td>
			<td class="info">Ngày vào làm:</td>
			<td class="info"><input size="20" type="text" name="ngayVaoLam" value="<?php  echo $ngayVaoLam;?>" /></td>
		</tr>
		<tr>
			<td class="info">Giới tính:</td>
			<td class="info">
				<input type="radio" name="radGT" value="nam" checked <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nam') echo 'checked="checked"';?>>Nam 
				<input type="radio" name="radGT" value="nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nu') echo 'checked="checked"';?>>Nữ
			</td>
			<td class="info">Hệ số lương:</td>
			<td class="info"><input size="10" type="text" name="heSoLuong" value="<?php  echo $heSoLuong;?>" /></td>
		</tr>
		<tr>
			<td class="info">Loại nhân viên:</td>
			<td class="info">
				<input type="radio" name="radNV" value="vp" checked <?php if(isset($_POST['radNV'])&&$_POST['radNV']=='vp') echo 'checked="checked"';?>>Văn phòng 
			</td>
			<td class="info" colspan="2">
				<input type="radio" name="radNV" value="sx" <?php if(isset($_POST['radNV'])&&$_POST['radNV']=='sx') echo 'checked="checked"';?>>Sản xuất 
			</td>
		</tr>
		<tr>
			<td class="info"></td>
			<td class="info">Số ngày vắng: <input size="10" type="text" name="soNgayVang" value="<?php  echo $soNgayVang;?>" /></td>
			<td class="info" colspan="2">Số sản phẩm: <input size="10" type="text" name="soSP" value="<?php  echo $soSP;?>" /></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><input type="submit" name="tinh" value="Tính Lương" /></td>
		</tr>
		<tr>
			<td class="info" align="center">Tiền lương:</td>
			<td class="info" align="center"><input size="20" type="text" name="tienLuong" value="<?php  echo $tienLuong;?>" disabled style="background: white;" /></td>
			<td class="info" align="center">Trợ cấp:</td>
			<td class="info" align="right"><input size="20" type="text" name="troCap" value="<?php  echo $troCap;?>" disabled style="background: white;" /></td>
		</tr>
		<tr>
			<td class="info" align="center">Tiền thưởng:</td>
			<td class="info" align="center"><input size="20" type="text" name="tienThuong" value="<?php  echo $tienThuong;?>" disabled style="background: white;" /></td>
			<td class="info" align="center">Tiền phạt:</td>
			<td class="info" align="right"><input size="20" type="text" name="tienPhat" value="<?php  echo $tienPhat;?>" disabled style="background: white;" /></td>
		</tr>
		<tr>
			<td class="info" colspan="4" align="center">
				Thực lĩnh: <input size="30" type="text" name="thucLinh" value="<?php  echo $thucLinh;?>" disabled style="background: white;" />
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
				<?php echo $thongBao; ?>
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