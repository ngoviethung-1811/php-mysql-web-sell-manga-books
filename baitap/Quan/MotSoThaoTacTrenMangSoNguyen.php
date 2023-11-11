<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<style type="text/css">

    table {

        color: #ffff00;

        background-color: gray;

    }

    table th {

        background-color: blue;

        font-family: 'vni-times';

        color: yellow;

    }

</style>

<?php
if (isset($_POST['n'])) {
    $n = (int)$_POST['n'];
} else {
    $n = 0;
}

$kq = "";
if (isset($_POST['tinh']) && $n > 0) {
    $a = taoMang($n);
    $str = implode(' ', $a);
    $kq = "Mảng được tạo là: " . $str . "\n";
    $kq .= "Số phần tử chẵn là: " . DemSoChan($a) . "\n";
    $kq .= "Số phần tử nhỏ hơn 100 là: " . DemSoLonHon100($a) . "\n";
    $kq .= "Tổng số âm là: " . TongSoAm($a) . "\n";
    $kq .= "Vị trí của các số kết thúc bằng 0: " . implode(', ', ViTriSoKetThucBang0($a)) . "\n";
    $kq .= "Sắp xếp mảng tăng dần: " . implode(' ', SapXepTangDan($a)) . "\n";
}

function taoMang($soPT)
{
    $arr = array();
    for ($i = 0; $i < $soPT; $i++) {
        $arr[$i] = rand(-1000, 1000);
    }
    return $arr;
}


function DemSoChan($arr)
{
    $dem = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] % 2 == 0) {
            $dem++;
        }
    }
    return $dem;
}

function DemSoLonHon100($arr)
{
    $dem = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] < 100) {
            $dem++;
        }
    }
    return $dem;
}

function TongSoAm($arr)
{
    $tong = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] < 0) {
            $tong = $tong + $arr[$i];
        }
    }
    return $tong;
}

function ViTriSoKetThucBang0($arr)
{
    $viTri = array();
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] % 10 === 0) {
            $viTri[] = $i;
        }
    }
    return $viTri;
}

function SapXepTangDan($arr)
{
    sort($arr);
    return $arr;
}
?>

<form action="" method="post">

<table border="1" cellpadding="0">

    <th colspan="2"><h2>Một số thao tác trên mảng</h2></th>

    <tr>

        <td>Nhập n:</td>

        <td><input type="text" name="n" size="70" value="<?php echo $n; ?>" /></td>

    </tr>

    <tr>

        <td></td>

        <td colspan="2" align="center"><input type="submit" name="tinh" size="20" value="   Xử lý   " /></td>

    </tr>

    <tr>
        <td colspan="2"><textarea name="ketqua" cols="70" rows="10"><?php echo $kq; ?></textarea></td>
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
