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
    if (isset($_POST['n']))
        $n = trim($_POST['n']);
    else $n = '';
    if (isset($_POST['mang']))
        $mang = trim($_POST['mang']);
    else $mang = '';
    if (isset($_POST['max']))
        $max = trim($_POST['max']);
    else $max = '';
    if (isset($_POST['min']))
        $min = trim($_POST['min']);
    else $min = '';
    if (isset($_POST['tong']))
        $tong = trim($_POST['tong']);
    else $tong = '';

    function tao_mang($num) {
        $arr = array();
        for ($i = 0; $i < $num; $i++)
            $arr[] = rand(0, 20);
        return $arr;
    }

    function xuat_mang($arr) {
        $str = '';
        for ($i = 0; $i < count($arr); $i++)
            $str .= "$arr[$i] ";
        return $str;
    }

    function tinh_tong($arr) {
        $sum = 0;
        for ($i = 0; $i < count($arr); $i++)
            $sum += $arr[$i];
        return $sum;
    }

    function tim_max($arr) {
        $max = PHP_INT_MIN;
        foreach ($arr as $value)
            if ($value > $max)
                $max = $value;
        return $max;
    }

    function tim_min($arr) {
        $min = PHP_INT_MAX;
        foreach ($arr as $value)
            if ($value < $min)
                $min = $value;
        return $min;
    }

    if (isset($_POST['xuly'])) {
        if (is_numeric($n)) {
            $arr = tao_mang($n);
            $mang = xuat_mang($arr);
            $tong = tinh_tong($arr);
            $max = tim_max($arr);
            $min = tim_min($arr);
        }
        else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            $mang = "";
            $max = "";
            $min = "";
            $tong = "";
        }
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h3></th>
        </thead>
        <tr>
            <td class="input_field">Nhập số phần tử: </td>
            <td class="input_field"><input type="text" size="30" name="n" value="<?php  echo $n;?> "/></td>
        </tr>
        <tr>
            <td class="input_field"></td>
            <td class="input_field"><input type="submit" value="     Phát sinh và tính toán     " name="xuly" style="background: #cccc00;" /></td>
        </tr>
        <tr>
            <td>Mảng: </td>
            <td><input type="text" size="40" name="mang" value="<?php  echo $mang;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>GTLN (MAX) trong mảng: </td>
            <td><input type="text" size="15" name="max" value="<?php  echo $max;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>GTNN (MIN) trong mảng: </td>
            <td><input type="text" size="15" name="min" value="<?php  echo $min;?>" disabled="disabled" class="output_field"></td>
        </tr>
        <tr>
            <td>Tổng mảng: </td>
            <td><input type="text" size="15" name="tong" value="<?php  echo $tong;?>" disabled="disabled" class="output_field"></td>
        </tr>             
        <tr>
            <td colspan="2" align="center">(<span style="color: red;">Ghi chú: </span>Các phần tử trong mảng sẽ có giá trị từ 0 đến 20)</td>
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