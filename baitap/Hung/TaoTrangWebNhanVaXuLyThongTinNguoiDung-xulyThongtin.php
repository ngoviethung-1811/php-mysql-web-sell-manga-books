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
	if(isset($_POST['hoTen']))  
	    $hoTen = trim($_POST['hoTen']);
	else
	    $hoTen = "";
	if(isset($_POST['diaChi']))  
	    $diaChi = trim($_POST['diaChi']);
	else
	    $diaChi = "";
	if(isset($_POST['sdt']))  
	    $sdt = trim($_POST['sdt']);
	else
	    $sdt = "";
	if(isset($_POST['radGT']))  
	    $gt = $_POST['radGT'];
	else
	    $gt = "";
	if(isset($_POST['nationality']))  
	    $nationality = $_POST['nationality'];
	else
	    $nationality = "";
	if(isset($_POST['mon1']))  
	    $mon1 = $_POST['mon1'];
	else
	    $mon1 = "";
	if(isset($_POST['mon2']))  
	    $mon2 = $_POST['mon2'];
	else
	    $mon2 = "";
	if(isset($_POST['mon3']))  
	    $mon3 = $_POST['mon3'];
	else
	    $mon3 = "";
	if(isset($_POST['mon4']))  
	    $mon4 = $_POST['mon4'];
	else
	    $mon4 = "";
	if(isset($_POST['ghichu']))  
	    $ghichu = trim($_POST['ghichu']);
	else
	    $ghichu = "";

	if ($hoTen == "" || $diaChi == "" || $sdt == "") {
		echo "<font color='red'>Vui lòng nhập đầy đủ thông tin! </font>";
		echo "<br><a href='javascript:window.history.back(-1);'>Trở về trang trước</a>";
	}
	else {
		echo "<b>Bạn đã đăng nhập thành công, dưới đây là những thông tin bạn nhập:</b><br><br>";
		echo "Họ tên: $hoTen";
		echo "<br>Giới tính: ";
		if ($gt === 'Nam') echo "Nam";
		else echo "Nữ";
		echo "<br>Địa chỉ: $diaChi";
		echo "<br>Điện thoại: $sdt";
		echo "<br>Quốc tịch: ";
		switch ($nationality) {
			case 'vi':
				echo "Việt Nam";
				break;
			case 'en':
				echo "Anh";
				break;
			default:
				break;
		}
		echo "<br>Môn học: ";
		if($mon1=="php_mysql") echo "PHP & MySQL, ";
		if($mon2=="csharp") echo "C#, ";
		if($mon3=="xml") echo "XML, ";
		if($mon4=="python") echo "Python, ";
		echo "<br>Ghi chú: $ghichu";
		echo "<br><br><a href='javascript:window.history.back(-1);'>Trở về trang trước</a>";
	}

?>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>