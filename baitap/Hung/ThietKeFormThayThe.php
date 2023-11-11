<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<style>
    table{
    border: 0 solid yellow;
    width: 500;
    }
    thead{
        background: #d40d9b;    
    }
    h3{
        font-family: verdana;
        text-align: center;
        /* text-anchor: middle; */
        color: white;
        font-size: medium;
    }
    .input_field{
        background: #f0d8e9;
    }
    .output_field{
        background: #f0995b;
    }
</style>
<?php 
    if(isset($_POST['day_so']))  
        $day_so=trim($_POST['day_so']); 
    else $day_so='';
    if(isset($_POST['gtCanThay']))  
        $gtCanThay=trim($_POST['gtCanThay']); 
    else $gtCanThay='';
    if(isset($_POST['gtThay']))  
        $gtThay=trim($_POST['gtThay']); 
    else $gtThay='';
    if(isset($_POST['mangCu']))  
        $mangCu=trim($_POST['mangCu']); 
    else $mangCu='';
    if(isset($_POST['mangMoi']))  
        $mangMoi=trim($_POST['mangMoi']); 
    else $mangMoi='';

    function thay_the(&$mang, $cu, $moi) {
        for ($i = 0; $i < count($mang); $i++)
            if ($mang[$i] == $cu)
                $mang[$i] = $moi;
    }

    function xuat_mang($mang) {
        $str = '';
        for ($i = 0; $i < count($mang); $i++)
            $str .= $mang[$i] . " ";
        return $str;
    }

    if(isset($_POST['xuly'])) {
        $arr = explode(",", $day_so);
        $mangCu = xuat_mang($arr);
        thay_the($arr, $gtCanThay, $gtThay);
        $mangMoi = xuat_mang($arr);
    }
    else {
        $mangCu = '';
        $mangMoi = '';
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>THAY THẾ</h3></th>
        </thead>
        <tr>
            <td class="input_field">Nhập các phần tử: </td>
            <td class="input_field"><input type="text" size="40" name="day_so" value="<?php  echo $day_so;?> "/></td>
        </tr>
        <tr>
            <td class="input_field">Giá trị cần thay thế: </td>
            <td class="input_field"><input type="text" size="15" name="gtCanThay" value="<?php  echo $gtCanThay;?> "/></td>
        </tr>
        <tr>
            <td class="input_field">Giá trị thay thế: </td>
            <td class="input_field"><input type="text" size="15" name="gtThay" value="<?php  echo $gtThay;?> "/></td>
        </tr>
        <tr>
            <td class="input_field"></td>
            <td class="input_field"><input type="submit" value="Thay thế" name="xuly" style="background: #cccc00;" /></td>
        </tr>
        <tr>
            <td>Mảng cũ: </td>
            <td><input type="text" size="40" name="mangCu" value="<?php  echo $mangCu;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>Mảng mới: </td>
            <td><input type="text" size="40" name="mangMoi" value="<?php  echo $mangMoi;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">(<span style="color: red;">Ghi chú: </span>Các phần tử trong mảng sẽ cách nhau bằng dấu ",")</td>
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