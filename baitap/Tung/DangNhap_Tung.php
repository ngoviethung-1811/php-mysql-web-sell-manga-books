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
if(isset($_POST['username']))  
    $username=trim($_POST['username']); 
else $username="";
if(isset($_POST['password']))  
    $password=trim($_POST['password']); 
else $password=null;
if(isset($_POST['dangnhap']))
{
	$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') 
        OR die('Could not connect to MySQL: ' . mysqli_connect_error());
	$sql = "SELECT Username,Password FROM user WHERE Username = '$username' AND Password = '$password'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) <> 0) {
		header("Location:ThongTinSua_Tung.php");
		exit();
    }
	else
		echo "Đăng nhập lại";
}
if(isset($_POST['dangky']))
{
	header("Location:DangKyNguoiDung_Tung.php");
	exit();
}
?>
<form align='center' action="" method="post">
<table align='center'>
    <thead>
        <th colspan="2" align="center"><h3>Đăng nhập</h3></th>
    </thead>
    <tr><td>Nhập Username:</td>
     <td><input type="text" name="username" value=""/></td>
    </tr>
    <tr><td>Nhập Password:</td>
     <td><input type="password" name="password" value=""/></td>
    </tr>
    <tr>
     <td colspan="2" align="center"><input type="submit" value="Đăng nhập" name="dangnhap" />
		<form action="DangKyNguoiDung_Tung.php" method="post">
			<input type="submit" name="dangky" value="Đăng ký">
		</form></td>
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