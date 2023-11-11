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
    if(isset($_POST['n']))
        $n = trim($_POST['n']);
    else $n = 0;
    if(isset($_POST['ketqua']))
        $ketqua = trim($_POST['ketqua']);
    else $ketqua = '';

    function hienThiMang($arr) {
        $str = '';
        for($i=0; $i<count($arr); $i++)
            $str .= "$arr[$i] ";
        return $str;
    }

    function demSoPTChan($arr) {
        $count = 0;
        for($i=0; $i<count($arr); $i++)
            if ($arr[$i] % 2 == 0)
                $count++;
        return $count;
    }

    function demSoPTNhoHon100($arr) {
        $count = 0;
        for($i=0; $i<count($arr); $i++)
            if ($arr[$i] < 100)
                $count++;
        return $count;
    }

    function tongPTAm($arr) {
        $sum = 0;
        for($i=0; $i<count($arr); $i++)
            if ($arr[$i] < 0)
                $sum += $arr[$i];
        return $sum;
    }

    function inVTPTSoKeCuoiLa0($arr) {
        $str = '';
        for($i=0; $i<count($arr); $i++)
            if ($arr[$i] >= 100 || $arr[$i] <= -100) {
                $num = $arr[$i];
                $num = (int)($num / 10);
                if ($num % 10 == 0)
                    $str .= "$i ";
            }
        return $str;
    }

    function sapXepTangDan(&$arr) {
        $n = count($arr);
        for($i = 0; $i < $n - 1; $i++){
            for($j = $i + 1; $j < $n; $j++){
                if($arr[$i] > $arr[$j]){
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $tmp;        
                }
            }
        }
    }

    if (isset($_POST['xuly'])) {
        if (is_numeric($n)) {
            $a = array();
            for($i=0; $i<$n; $i++)
                $a[$i] = rand(-1000, 1000);
            $ketqua = "Mảng được tạo ra là: " . hienThiMang($a);
            $ketqua .= "\nSố phần tử chẵn trong mảng: " . demSoPTChan($a);
            $ketqua .= "\nSố phần tử trong mảng <100: " . demSoPTNhoHon100($a);
            $ketqua .= "\nTổng các phần tử âm trong mảng: " . tongPTAm($a);
            $ketqua .= "\nVị trí của các thành phần trong mảng có chữ số kề cuối là 0: " . inVTPTSoKeCuoiLa0($a);
            sapXepTangDan($a);
            $ketqua .= "\nMảng được sắp xếp tăng dần là: " . hienThiMang($a);
        }
        else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            $ketqua="";
        }
    }
?>
<form action="" method="post">
<table border="0" cellpadding="0" style="color: #ffff00; background-color: gray;">
    <th colspan="2" style="background-color: blue; font-style: vni-times; color: yellow;">
        <h2>MỘT SỐ THAO TÁC TRÊN MẢNG</h2>
    </th>
    <tr>
        <td>Nhập n:</td>
        <td><input type="text" name="n" size= "30" value="<?php echo $n;?> "/></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" name="xuly"  size="20" value="  Xử lý  "/></td>
    </tr>
    <tr>
        <td colspan="2"><textarea cols="70" rows="10" name="ketqua"> <?php echo $ketqua?></textarea></td>
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