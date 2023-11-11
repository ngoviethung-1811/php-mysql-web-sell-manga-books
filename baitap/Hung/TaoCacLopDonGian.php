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
	class Nguoi {
		private $hoten;
		private $diachi;
		private $gioitinh;

		public function __construct($hoten, $diachi, $gioitinh) {
			$this->hoten = $hoten;
			$this->diachi = $diachi;
			$this->gioitinh = $gioitinh;
		}

		public function setHoTen($hoten) {
			$this->hoten = $hoten;
		}

		public function getHoTen() {
			return $this->hoten;
		}

		public function setDiaChi($diachi) {
			$this->diachi = $diachi;
		}

		public function getDiaChi() {
			return $this->diachi;
		}

		public function setGioiTinh($gioitinh) {
			$this->gioitinh = $gioitinh;
		}

		public function getGioiTinh() {
			return $this->gioitinh;
		}
	}

	class SinhVien extends Nguoi {
		private $lop;
		private $nganh;

		public function __construct($hoten, $diachi, $gioitinh, $lop, $nganh) {
			parent::__construct($hoten, $diachi, $gioitinh);
			$this->lop = $lop;
			$this->nganh = $nganh;
		}

		public function setLop($lop) {
			$this->lop = $lop;
		}

		public function getLop() {
			return $this->lop;
		}

		public function setNganh($nganh) {
			$this->nganh = $nganh;
		}

		public function getNganh() {
			return $this->nganh;
		}

		public function tinhDiemThuong() {
			if ($this->nganh == "CNTT") return 1;
			if ($this->nganh == "KT") return 1.5;
			return 0;
		}
	}

	class GiangVien extends Nguoi {
		private $trinhdo;
		public const LUONGCB = 1500000;

		public function __construct($hoten, $diachi, $gioitinh, $trinhdo) {
			parent::__construct($hoten, $diachi, $gioitinh);
			$this->trinhdo = $trinhdo;
		}

		public function setTrinhDo($trinhdo) {
			$this->trinhdo = $trinhdo;
		}

		public function getTrinhDo() {
			return $this->trinhdo;
		}

		public function tinhLuong() {
			if ($this->trinhdo == "Cử nhân") return self::LUONGCB * 2.34;
			if ($this->trinhdo == "Thạc sĩ") return self::LUONGCB * 3.67;
			if ($this->trinhdo == "Tiến sĩ") return self::LUONGCB * 5.66;
		}
	}

	if (isset($_POST['hoTen']))
		$hoTen = trim($_POST['hoTen']);
	else $hoTen = '';
	if (isset($_POST['diaChi']))
		$diaChi = trim($_POST['diaChi']);
	else $diaChi = '';
	if (isset($_POST['radGT']))
		$gioiTinh = $_POST['radGT'];
	else $gioiTinh = '';
	if (isset($_POST['lopHoc']))
		$lopHoc = trim($_POST['lopHoc']);
	else $lopHoc = '';
	if (isset($_POST['nganhHoc']))
		$nganhHoc = trim($_POST['nganhHoc']);
	else $nganhHoc = '';
	if (isset($_POST['trinhDo']))
		$trinhDo = trim($_POST['trinhDo']);
	else $trinhDo = '';
	if (isset($_POST['loai']))
		$loai = trim($_POST['loai']);
	else $loai = '';
	
	if (isset($_POST['xacnhan'])) {
		if ($hoTen!='' && $diaChi!='' && $gioiTinh!='' && $loai!='') {
			if ($loai==="sv" && $lopHoc!='' && $nganhHoc!='') {
				$thongBao='';

				$sv = new SinhVien($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc);
				$diem = $sv->tinhDiemThuong();
				
				$ketqua = "<td align='center'>Điểm thưởng</td>";
				$ketqua .= "<td align='center'><input size='20' type='text' value='$diem' disabled style='background: white;' /></td>";
			}
			elseif ($loai==="gv" && $trinhDo!='') {
				$thongBao='';

				$gv = new GiangVien($hoTen, $diaChi, $gioiTinh, $trinhDo);
				$luong = $gv->tinhLuong();
				
				$ketqua = "<td align='center'>Lương</td>";
				$ketqua .= "<td align='center'><input size='20' type='text' value='$luong' disabled style='background: white;' /></td>";
			}
			else {
				$ketqua = '';
				$thongBao = "<font color='red'>Vui lòng nhập đầy đủ thông tin!</font>";
			}
		}
		else {
			$ketqua = '';
			$thongBao = "<font color='red'>Vui lòng nhập đầy đủ thông tin!</font>";
		}
	}
	else {
		$ketqua = '';
		$thongBao = '';
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
	.hidden {
		display: none;
	}
</style>
<form action="" method="POST">
	<table>
		<thead>
			<th colspan="4" id="tablehead">NHẬP THÔNG TIN GV/SV</th>
		</thead>
		<tr>
			<td class="info">Họ và tên:</td>
			<td class="info"><input size="40" type="text" name="hoTen" value="<?php  echo $hoTen;?>" /></td>
		</tr>
		<tr>
			<td class="info">Địa chỉ:</td>
			<td class="info"><input size="40" type="text" name="diaChi" value="<?php  echo $diaChi;?>" /></td>
		</tr>
		<tr>
			<td class="info">Giới tính:</td>
			<td class="info">
				<input type="radio" name="radGT" value="nam" checked <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nam') echo 'checked="checked"';?>>Nam 
				<input type="radio" name="radGT" value="nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='nu') echo 'checked="checked"';?>>Nữ
			</td>
		</tr>
		<tr>
			<td class="info">Thông tin: </td>
			<td class="info">
				<select name="loai" id="loai">
					<option value="sv" <?php if(isset($_POST['loai'])&& $_POST['loai']=='sv') echo 'selected';?> selected>Sinh viên</option>
					<option value="gv" <?php if(isset($_POST['loai'])&& $_POST['loai']=='gv') echo 'selected';?>>Giảng viên</option>
				</select>
			</td>
		</tr>
		<tr class="sinhVien">
			<td class="info">Lớp học:</td>
			<td class="info"><input size="20" type="text" name="lopHoc" value="<?php  echo $lopHoc;?>" /></td>
		</tr>
		<tr class="sinhVien">
			<td class="info">Ngành học:</td>
			<td class="info"><input size="40" type="text" name="nganhHoc" value="<?php  echo $nganhHoc;?>" /></td>
		</tr>
		<tr id="giangVien">
			<td class="info">Trình độ:</td>
			<td class="info"><input size="20" type="text" name="trinhDo" value="<?php  echo $trinhDo;?>" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="xacnhan" value="Xác nhận" /></td>
		</tr>
		<tr id="output">
			<?php  echo $ketqua;?>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<?php echo $thongBao; ?>
			</td>
		</tr>
	</table>
</form>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var loai = document.getElementById('loai');
		var sinhVienInfo = document.getElementsByClassName('sinhVien');
		var giangVienInfo = document.getElementById('giangVien');
		var output = document.getElementById('output');

		loai.addEventListener('change', function() {
			output.classList.add('hidden');
			if (this.value === 'sv') {
				for (let i = 0; i < sinhVienInfo.length; i++) {
					sinhVienInfo[i].classList.remove('hidden');
				}
				giangVienInfo.classList.add('hidden');
			} else if (this.value === 'gv') {
				for (let i = 0; i < sinhVienInfo.length; i++) {
					sinhVienInfo[i].classList.add('hidden');
				}
				giangVienInfo.classList.remove('hidden');
			}
		});

		if (loai.value === 'sv') {
			for (let i = 0; i < sinhVienInfo.length; i++) {
				sinhVienInfo[i].classList.remove('hidden');
			}
			giangVienInfo.classList.add('hidden');
		} else if (loai.value === 'gv') {
			for (let i = 0; i < sinhVienInfo.length; i++) {
				sinhVienInfo[i].classList.add('hidden');
			}
			giangVienInfo.classList.remove('hidden');
		}
	});
</script>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>
