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
    if(isset($_POST['mangA']))  
        $mangA=trim($_POST['mangA']); 
    else $mangA='';
    if(isset($_POST['mangB']))  
        $mangB=trim($_POST['mangB']); 
    else $mangB='';
    if(isset($_POST['soptA']))  
        $soptA=trim($_POST['soptA']); 
    else $soptA=0;
    if(isset($_POST['soptB']))  
        $soptB=trim($_POST['soptB']); 
    else $soptB=0;
    if(isset($_POST['mangC']))  
        $mangC=trim($_POST['mangC']); 
    else $mangC='';
    if(isset($_POST['mangCTang']))  
        $mangCTang=trim($_POST['mangCTang']); 
    else $mangCTang='';
    if(isset($_POST['mangCGiam']))  
        $mangCGiam=trim($_POST['mangCGiam']); 
    else $mangCGiam='';

    if(isset($_POST['xuly'])) {
        $arrA = explode(",", $mangA);
        $arrB = explode(",", $mangB);

        $soptA = count($arrA);
        $soptB = count($arrB);

        $arrC = array_merge($arrA, $arrB);
        $countC = count($arrC);

        $mangC = implode(", ", $arrC);

        sort($arrC);
        $mangCTang = implode(", ", $arrC);

        rsort($arrC);
        $mangCGiam = implode(", ", $arrC);
    }
    else {
        $soptA = 0;
        $soptB = 0;
        $mangC = '';
        $mangCTang = '';
        $mangCGiam = '';
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>ĐẾM PHẦN TỬ, GHÉP MẢNG VÀ SẮP XẾP</h3></th>
        </thead>
        <tr>
            <td class="input_field">Mảng A: </td>
            <td class="input_field"><input type="text" size="30" name="mangA" value="<?php  echo $mangA;?> "/></td>
        </tr>
        <tr>
            <td class="input_field">Mảng B: </td>
            <td class="input_field"><input type="text" size="30" name="mangB" value="<?php  echo $mangB;?> "/></td>
        </tr>
        <tr>
            <td class="input_field"></td>
            <td class="input_field"><input type="submit" value="Thực hiện" name="xuly" style="background: #cccc00;" /></td>
        </tr>
        <tr>
            <td>Số phần tử mảng A: </td>
            <td><input type="text" size="15" name="soptA" value="<?php  echo $soptA;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>Số phần tử mảng B: </td>
            <td><input type="text" size="15" name="soptB" value="<?php  echo $soptB;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>Mảng C: </td>
            <td><input type="text" size="40" name="mangC" value="<?php  echo $mangC;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>Mảng C tăng dần: </td>
            <td><input type="text" size="40" name="mangCTang" value="<?php  echo $mangCTang;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>Mảng C giảm dần: </td>
            <td><input type="text" size="40" name="mangCGiam" value="<?php  echo $mangCGiam;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">(<span style="color: red;">Ghi chú: </span>Các phần tử trong mảng sẽ có cách nhau bằng dấu ",")</td>
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