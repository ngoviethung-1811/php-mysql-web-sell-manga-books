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
if(isset($_POST['email']))  
    $email=trim($_POST['email']); 
else $email="";
if(isset($_POST['password']))  
    $password=trim($_POST['password']); 
else $password=null;
if(isset($_POST['tinh']))
{
	$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') 
        OR die('Could not connect to MySQL: ' . mysqli_connect_error());
	$sql = "INSERT INTO user(Username,Password,Email) VALUES ('$username', '$password', '$email')";
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "Đăng ký lại!";
    }
	else
	{
		header("Location:DangNhap_Tung.php");
		echo "Đăng ký thành công";
		exit();
	}
}
?>
<form align='center' action="" method="post">
<table align='center'>
    <thead>
        <th colspan="2" align="center"><h3>Đăng ký</h3></th>
    </thead>
    <tr><td>Nhập Username:</td>
     <td><input type="text" name="username" value=""/></td>
    </tr>
	<tr><td>Nhập Email:</td>
     <td><input type="text" name="email" value=""/></td>
    </tr>
    <tr><td>Nhập Password:</td>
     <td><input type="password" name="password" value=""/></td>
    </tr>
    <tr>
     <td colspan="2" align="center"><input type="submit" value="Đăng ký" name="tinh" /></td>
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