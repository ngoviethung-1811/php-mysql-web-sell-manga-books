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
        margin: 0 auto;
    }

    table th {
        background-color: blue;
        font-family: 'vni-times';
        color: yellow;
    }

    input[type="text"], input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
    }

    input[type="text"][disabled] {
        background-color: #ddd;
    }
</style>

<?php
function tongmang($m)
{
    $tong = 0;
    for ($i = 0; $i < count($m); $i++) {
        $tong += $m[$i];
    }
    return $tong;
}
?>

<?php
$tong = "";
if (isset($_POST['mang']))
    $mang = $_POST['mang'];
else
    $mang = "";
if (isset($_POST['tinh']) && isset($mang)) {
    $m = explode(",", $mang);
    $tong = tongmang($m);
} else {
    echo "Hãy nhập dữ liệu vào ô input";
}
?>

<form action="" method="post">
    <table border="0" cellpadding="0">
        <th colspan="2"><h2>Tìm kiếm</h2></th>
        <tr>
            <td>Nhập mảng:</td>
            <td><input type="text" name="mang" size="40" value="<?php echo $mang; ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="tinh" value="Tổng dãy số" /></td>
        </tr>
        <tr>
            <td>Tổng dãy số:</td>
            <td><input type="text" disabled="disabled" name="n" value="<?php echo $tong; ?>" /></td>
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