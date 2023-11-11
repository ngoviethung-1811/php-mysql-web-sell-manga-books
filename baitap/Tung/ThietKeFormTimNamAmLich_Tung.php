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
$nam_al="";
$hinhanh="";
$mang_can=array("Quý","Giáp","Ất","Bính","Đinh","Mậu","Kỷ","Canh","Tân","Nhâm");
$mang_chi=array("Hợi","Tí","Sửu","Dần","Mão","Thìn","Tỵ","Ngọ","Mùi","Thân","Dậu","Tuất");
$mang_hinh=array("hoi.jpg","chuot.jpg","suu.jpg","dan.jpg","meo.jpg","thin.jpg","ty.jpg","ngo.jpg","mui.jpg","than.jpg","dau.jpg","tuat.jpg");
if(isset($_POST['nam_dl']))
	$nam_dl=$_POST['nam_dl'];
else 
	$nam_dl="";
if(isset($_POST['tinh']) && is_numeric($nam_dl))
{
	$nam=$nam_dl-3;
	$can=$nam%10;
	$chi=$nam%12;
	$nam_al=$mang_can[$can];
	$nam_al=$nam_al." ".$mang_chi[$chi];
	$hinh=$mang_hinh[$chi];
	$hinhanh="<img width=100px height=100px src='images_Tung/$hinh'>";
}
else
	echo "Hãy nhập số vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th ><h2>Tìm năm âm lịch</h2></th>

    <tr>
        <td >Năm dương lịch:</td>
		<td></td>
        <td >Năm âm lịch</td>
    </tr>
	 <tr>
        <td ><input type="text" name="nam_dl" size= "20" value="<?php echo $nam_dl;?> "/></td>
		<td  align="center"><input type="submit" name="tinh"  size="10" value="=>"/></td>
        <td ><input type="textfield" disabled=disable name="nam_al" size= "20" value="<?php echo $nam_al;?> "/></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo $hinhanh;?></td>
		<td></td>
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


