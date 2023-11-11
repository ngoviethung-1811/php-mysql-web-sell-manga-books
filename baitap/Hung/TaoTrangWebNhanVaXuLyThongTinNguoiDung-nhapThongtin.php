<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<form action="TaoTrangWebNhanVaXuLyThongTinNguoiDung-xulyThongtin.php" method="post">
	<fieldset>
		<legend><b>Enter your information</b></legend>
		<table>
			<tr>
				<td>Họ tên:</td>
				<td><input type="text" size=40 name="hoTen" value="<?php if(isset($_POST['hoTen'])) echo $_POST['hoTen'] ?> "/></td>
			</tr>
			<tr>
				<td>Địa chỉ:</td>
				<td><input type="text" size=40 name="diaChi" value="<?php if(isset($_POST['diaChi'])) echo $_POST['diaChi'] ?> "/></td>
			</tr>
			<tr>
				<td>Số điện thoại:</td>
				<td><input type="text" size=20 name="sdt" value="<?php if(isset($_POST['sdt'])) echo $_POST['sdt'] ?> "/></td>
			</tr>
			<tr>
				<td>Giới tính:</td>
				<td>
					<input type="radio" name="radGT" value="Nam"<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?> checked/> Nam 
					<input type="radio" name="radGT" value="Nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nu') echo 'checked="checked"';?>/>
							N&#7919;<br>
				</td>
			</tr>
			<tr>
				<td>Quốc tịch:</td>
				<td>
					<select name="nationality">
						<option value="vi" <?php if(isset($_POST['nationality'])&& $_POST['nationality']=='vi') echo 'selected';?>>
							Việt Nam
						</option>
						<option value="en" <?php if(isset($_POST['nationality'])&& $_POST['nationality']=='en') echo 'selected';?>>
							Anh
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Các môn đã học:</td>
				<td>
					<input type="checkbox" name="mon1" value="php_mysql" 
						<?php if(isset($_POST['mon1'])&& $_POST['mon1']=='php_mysql') echo 'checked'; else echo ""?>/> PHP & MySQL  
					<input type="checkbox" name="mon2" value="csharp"
						<?php if(isset($_POST['mon2'])&& $_POST['mon2']=='csharp') echo 'checked'; else echo ""?>/> C# 
					<input type="checkbox" name="mon3" value="xml"
						<?php if(isset($_POST['mon3'])&& $_POST['mon3']=='xml') echo 'checked'; else echo ""?>/> XML 
					<input type="checkbox" name="mon4" value="python"
						<?php if(isset($_POST['mon4'])&& $_POST['mon4']=='python') echo 'checked'; else echo ""?>/> Python 
				</td>
			</tr>
			<tr>
				<td>Ghi chú:</td>
				<td>
					<textarea name="ghichu" rows="3" cols="40"><?php if(isset($_POST['ghichu'])) echo $_POST['ghichu']; ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Gửi" name="gui" /> 
					<input type="reset" value="Huỷ" name="huy" />
				</td>
			</tr>
		</table>
	</fieldset>
</form>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>