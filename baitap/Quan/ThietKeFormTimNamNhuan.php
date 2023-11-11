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
    table {
        background-color: #bbecfc;
        width: 400px;
    }

    table th {
        background-color: blue;
        font-family: 'vni-times';
        color: white;
    }

    td {
        text-align: center;
    }

    h2 {
        color: #0074b4;
    }

    input[type="text"], input[type="submit"] {
        padding: 5px;
        width: 100%;
    }
</style>

<?php
if (isset($_POST['nam']))
    $nam = trim($_POST['nam']);
else $nam = 0;
if (isset($_POST['thongbao']))
    $thongbao = trim($_POST['thongbao']);
else $thongbao = '';
if (isset($_POST['ketqua']))
    $ketqua = trim($_POST['ketqua']);
else $ketqua = '';

function nam_nhuan($y) {
    if ($y % 400 == 0 || ($y % 4 == 0 && $y % 100 != 0))
        return 1;
    return 0;
}

if (isset($_POST['tim'])) {
    if (is_numeric($nam)) {
        if ($nam < 2000) $thongbao = "Năm nhập vào nhỏ hơn năm 2000";
        else $thongbao = "Năm nhập vào lớn hơn năm 2000";

        foreach (range(2000, $nam) as $n) {
            if (nam_nhuan($n)) $ketqua .= "$n ";
        }
        if ($ketqua != "") $ketqua = "$ketqua là năm nhuận";
        else $ketqua = "Không có năm nhuận";
    } else {
        echo "<font color='red'>Vui lòng nhập vào năm! </font>";
        $thongbao = "";
        $ketqua = "";
    }
}
?>

<form action="" method="post">
    <table border="0" cellpadding="0">
        <tr style="border: none;">
            <td colspan="2" align="center" style="color: blue; background-color: white;"><?php echo $thongbao; ?></td>
        </tr>
        <th colspan="2"><h2>TÌM NĂM NHUẬN</h2></th>
        <tr>
            <td>Năm: </td>
            <td><input type="text" name="nam" value="<?php echo $nam; ?>" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="background: #f5f0c6;"><?php echo $ketqua; ?></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="tim" value="Tìm năm nhuận" /></td>
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