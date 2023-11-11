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
    protected $ngayVaoLam;
    protected $heSoLuong;
    protected $soCon;
    const luongCoBan=1500000;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon) {
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngayVaoLam = $ngayVaoLam;
        $this->heSoLuong = $heSoLuong;
        $this->soCon = $soCon;
    }

    abstract function tinhTienLuong();

    abstract function tinhTroCap();

    public function tinhTienThuong() {
        $soNamLamViec = date('Y') - date('Y', strtotime($this->ngayVaoLam));
        $tienThuong = $soNamLamViec * 1000000;
        return $tienThuong;
    }
}

class NhanVienVanPhong extends NhanVien {
    const DINH_MUC_VANG = 3; // Định mức vắng
    const DON_GIA_PHAT = 100000; // Đơn giá phạt

    protected $soNgayVang;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang) {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soNgayVang = $soNgayVang;
    }

    public function tinhTienPhat() {
        $tienPhat = 0;

        if ($this->soNgayVang > self::DINH_MUC_VANG) {
            $soNgayVuotDinhMuc = $this->soNgayVang - self::DINH_MUC_VANG;
            $tienPhat = $soNgayVuotDinhMuc * self::DON_GIA_PHAT;
        }

        return $tienPhat;
    }

    public function tinhTroCap() {
        $troCap = 0;

        if ($this->gioiTinh == 'Nữ') {
            $troCap = 200000*intval($this->soCon)*1.5;
        } else {
            $troCap = 200000*intval($this->soCon);
        }

        return $troCap;
    }

    public function tinhTienLuong() {
        $tienPhat = $this->tinhTienPhat();
        $tienLuong = self::luongCoBan * $this->heSoLuong - $tienPhat;
        return $tienLuong;
    }
}

class NhanVienSanXuat extends NhanVien {
    const DINH_MUC_SAN_PHAM = 100; // Định mức sản phẩm
    const DON_GIA_SAN_PHAM = 10000; // Đơn giá sản phẩm

    protected $soSanPham;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham) {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soSanPham = $soSanPham;
    }

    public function tinhTienThuong() {
        $tienThuong = 0;

        if ($this->soSanPham > self::DINH_MUC_SAN_PHAM) {
            $soSanPhamVuotDinhMuc = $this->soSanPham - self::DINH_MUC_SAN_PHAM;
            $tienThuong = $soSanPhamVuotDinhMuc * self::DON_GIA_SAN_PHAM * 0.03;
        }

        return $tienThuong;
    }

    public function tinhTroCap() {
		$troCap = 0;
        $troCap = intval($this->soCon) *120000;
        return $troCap;
    }

    public function tinhTienLuong() {
        $tienThuong = $this->tinhTienThuong();
        $tienLuong = ($this->soSanPham * self::DON_GIA_SAN_PHAM) + $tienThuong;
        return $tienLuong;
    }
}
$hoten="";
$socon="";
$gioitinh="";
$hesoluong="";
$songayvang="";
$sosanpham="";
$tienluong="";
$trocap="";
$tienthuong="";
$tienphat="";
$thuclinh="";

if(isset($_POST["hoten"]))
	$hoten = $_POST["hoten"];
else $hoten="";

if(isset($_POST["socon"]))
	$socon= $_POST["socon"];
else $socon="";

if(isset($_POST["ngaysinh"]))
	$ngaysinh = $_POST["ngaysinh"];
else $ngaysinh="";

if(isset($_POST["ngayvaolam"]))
	$ngayvaolam = $_POST["ngayvaolam"];
else $ngayvaolam="";

if(isset($_POST["gioitinh"]))
		$gioitinh = $_POST["gioitinh"];
else $gioitinh="";

if(isset($_POST["hesoluong"]))
	$hesoluong = $_POST["hesoluong"];
else $hesoluong="";

if(isset($_POST["songayvang"]))
	$songayvang = $_POST["songayvang"];
else $songayvang="";

if(isset($_POST["sosanpham"]))
	$sosanpham = $_POST["sosanpham"];
else $sosanpham="";

if(isset($_POST["tinh"]))
{
	if(isset($_POST["loainhanvien"]) && ($_POST["loainhanvien"])=="vanphong")
	{
		$nv=new NhanVienVanPhong($hoten, $gioitinh, $ngayvaolam, $hesoluong, $socon, $songayvang);
		$tienluong=$nv->tinhTienLuong();
		$tienphat=$nv->tinhTienPhat();
		$trocap=$nv->tinhTroCap();
		$tienthuong=$nv->tinhTienThuong();
	}
	if(isset($_POST["loainhanvien"]) && ($_POST["loainhanvien"])=="sanxuat")
	{
		$nv=new NhanVienSanXuat($hoten, $gioitinh, $ngayvaolam, $hesoluong, $socon, $sosanpham);
		$tienluong=$nv->tinhTienLuong();
		$tienphat=0;
		$trocap=$nv->tinhTroCap();
		$tienthuong=$nv->tinhTienThuong();
	}
	$thuclinh=$tienluong+$tienthuong+$trocap-$tienphat;
}

?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="4"><h2>Quản lí nhân viên</h2></th>

    <tr>

        <td>Họ và tên:</td>

        <td><input type="text" name="hoten" size= "10" value="<?php echo $hoten;?> "/></td>
		<td>Số con:</td>

        <td><input type="text" name="socon" size= "10" value="<?php echo $socon;?> "/></td>

    </tr>
	<tr>

        <td>Ngày sinh:</td>

        <td><input type="date" name="ngaysinh" size= "10" value="<?php echo $ngaysinh;?> "/></td>
		<td>Ngày vào làm:</td>

        <td><input type="date" name="ngayvaolam" size= "10" value="<?php echo $ngayvaolam;?> "/></td>

    </tr>
	<tr>
		<td>Giới tính:</td>
		<td>
			<input type="radio" name="gioitinh" value="Nam" checked> Nam
			<input type="radio" name="gioitinh" value="Nữ"> Nữ
		</td>
		<td>Hệ số lương:</td>

        <td><input type="text" name="hesoluong" size= "10" value="<?php echo $hesoluong;?> "/></td>
	</tr>
	<tr>
		<td>Loại nhân viên:</td>
		<td>
			<input type="radio" name="loainhanvien" value="vanphong" checked> Văn phòng
		</td>
		<td><input type="radio" name="loainhanvien" value="sanxuat"> Sản xuất</td>

	</tr>
	<tr>

        <td></td>

        <td>Số ngày vắng:<input type="text" name="songayvang" size= "10" value="<?php echo $songayvang;?> "/></td>
		<td></td>
        <td>Số sản phẩm:<input type="text" name="sosanpham" size= "10" value="<?php echo $sosanpham;?> "/></td>

    </tr>
	<tr>
        <td></td>
        <td ><input type="submit" name="tinh"  size="20" value="Tính lương"/></td>

    </tr>
	 <tr>

        <td>Tiền lương:</td>

        <td><input type="textfield" disabled=disable name="tienluong" size= "10" value="<?php echo $tienluong;?> "/></td>
		<td>Trợ cấp:</td>

        <td><input type="textfield" disabled=disable name="trocap" size= "10" value="<?php echo $trocap;?> "/></td>

    </tr>
	<tr>

        <td>Tiền thưởng:</td>

        <td><input type="textfield" disabled=disable name="tienthuong" size= "10" value="<?php echo $tienthuong;?> "/></td>
		<td>Tiền phạt:</td>

        <td><input type="textfield" disabled=disable name="tienphat" size= "10" value="<?php echo $tienphat;?> "/></td>

    </tr>
	<tr>
		<td></td>
		<td>Thực lĩnh:<input type="textfield" disabled=disable name="thuclinh" size= "10" value="<?php echo $thuclinh;?> "></td>
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