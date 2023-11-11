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
if(isset($_POST['masua']))  
    $masua=trim($_POST['masua']); 
else $masua="";

if(isset($_POST['tensua']))  
    $tensua=trim($_POST['tensua']); 
else $tensua="";

if(isset($_POST['hangsua']))  
    $hangsua=trim($_POST['hangsua']); 
else $hangsua="";

if(isset($_POST['loaisua']))  
    $loaisua=trim($_POST['loaisua']); 
else $loaisua="";

if(isset($_POST['trongluong']))  
    $trongluong=trim($_POST['trongluong']); 
else $trongluong="";

if(isset($_POST['dongia']))  
    $dongia=trim($_POST['dongia']); 
else $dongia="";

if(isset($_POST['thanhphan']))  
    $thanhphan=trim($_POST['thanhphan']); 
else $thanhphan="";

if(isset($_POST['loiich']))  
    $loiich=trim($_POST['loiich']); 
else $loiich="";

if(isset($_FILES['image'])!=NULL){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=@strtolower(end(explode('.',$_FILES['image']['name'])));
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Don't accept image files with this extension, please choose JPEG or PNG.";
      }
      if($file_size > 2097152){
         $errors[]='File size should be 2MB';
		}
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,'Hinh_sua/'.$file_name);
         echo "Upload File successfully!!!";
      }
      else{
         print_r($errors);
      }
   }
else $file_name="";

if(isset($_POST['tinh']))
{
	$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') 
        OR die('Could not connect to MySQL: ' . mysqli_connect_error());
	$sql = "INSERT INTO sua (Ma_sua, Ten_sua, Ma_hang_sua, Ma_loai_sua, Trong_luong, Don_gia, TP_Dinh_Duong, Loi_ich, Hinh) VALUES ('$masua', '$tensua', '$hangsua', '$loaisua', '$trongluong', '$dongia', '$thanhphan', '$loiich', '$file_name')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "Thêm thành công";
    }
	else
	{
		echo "Lỗi khi thêm dũ liệu!";
	}
}
?>

<form align='center' action="" method="post" enctype="multipart/form-data">
<table align='center'>
    <thead>
        <th colspan="4" align="center"><h3>Thêm sửa mới</h3></th>
    </thead>
    <tr><td>Mã sửa:</td>
     <td><input type="text" name="masua" value=""/></td>
    </tr>
	<tr><td>Tên sửa:</td>
     <td><input type="text" name="tensua" value=""/></td>
    </tr>
    <tr><td>Hãng sửa:</td>
     <td>
		<select name="hangsua" >
            <?php
				// Kết nối đến máy chủ MySQL
				$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') 
					OR die('Could not connect to MySQL: ' . mysqli_connect_error());

				$query = "SELECT Ma_hang_sua,Ten_hang_sua FROM hang_sua";
				$result = mysqli_query($conn, $query);

				while ($row = mysqli_fetch_assoc($result)) {
					echo '<option value="' . $row['Ma_hang_sua'] . '">' . $row['Ten_hang_sua'] . '</option>';
				}
				mysqli_close($conn);
            ?>
        </select>
	 </td>
    </tr>
	 <tr><td>Loại sửa:</td>
     <td>
		<select name="loaisua" >
            <?php
				// Kết nối đến máy chủ MySQL
				$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') 
					OR die('Could not connect to MySQL: ' . mysqli_connect_error());

				$query = "SELECT Ma_loai_sua,Ten_loai FROM loai_sua";
				$result = mysqli_query($conn, $query);

				while ($row = mysqli_fetch_assoc($result)) {
					echo '<option value="' . $row['Ma_loai_sua'] . '">' . $row['Ten_loai'] . '</option>';
				}
				mysqli_close($conn);
            ?>
        </select>
	 </td>
	 <tr>
		<td>Trọng lượng:</td>
		 <td><input type="text" name="trongluong" value=""/></td>
	 </tr>
	 <tr>
		<td>Đơn giá:</td>
		 <td><input type="text" name="dongia" value=""/></td>
	 </tr>
	 <tr>
		<td>Thành phần:</td>
		 <td><textarea name="thanhphan"></textarea></td>
	 </tr>
	 <tr>
		<td>Lọi ích:</td>
		 <td><textarea name="loiich"></textarea></td>
	 </tr>
	 <tr>
		<td>Hình ảnh:</td>
		<td>
			<input type="file" name="image" />	
		</td>
	 </tr>
    </tr>
    <tr>
     <td colspan="2" align="center"><input type="submit" value="Thêm" name="tinh" /></td>
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