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

        color: #ffff00;

        background-color: gray;     

    }

    table th{

        background-color: blue;

        font-style: vni-times;

        color: yellow;

    }

</style>

<?php
function thayThePhanTu($m, $oldValue, $newValue)
{
    for ($i = 0; $i < count($m); $i++) {
        if ($m[$i] == $oldValue) {
            $m[$i] = $newValue;
        }
    }
    return $m;
}

?>

<?php 
$kq = "";
if (isset($_POST['mang']))
    $mang = $_POST['mang'];
else 
    $mang = "";
if (isset($_POST['n']))
    $n = $_POST['n'];
else 
    $n = "";
if (isset($_POST['tinh']) && isset($mang) && isset($_POST['old_value']))
{
    $m = explode(",", $mang);
    $old_value = $_POST['old_value'];
    
    $m_before_replace = $m; // Lưu trữ mảng gốc trước khi thay thế
    $m = thayThePhanTu($m, $old_value, $n);
    $kq = implode(",", $m);
}
else
    echo "Hãy nhập dữ liệu vào ô input";
?>

<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Thay thế phần tử trong mảng</h2></th>

    <tr>

        <td>Nhập mảng:</td>

        <td><input type="text" name="mang" size="40" value="<?php echo $mang; ?>"/></td>

    </tr>
    <tr>

        <td>Nhập giá trị cần thay thế:</td>

        <td><input type="text" name="old_value" size="10" value="<?php echo isset($_POST['old_value']) ? $_POST['old_value'] : ''; ?>"/></td>

    </tr>
    <tr>

        <td>Giá trị thay thế:</td>

        <td><input type="text" name="n" size="10" value="<?php echo $n; ?>"/></td>

    </tr>
    
    <tr>

        <td></td>

        <td><input type="submit" name="tinh" size="20" value="Thay thế"/></td>

    </tr>
    <tr>

        <td>Mảng cũ:</td>

        <td><input type="textfield" disabled="disable" name="n" size="40" value="<?php echo isset($m_before_replace) ? implode(",", $m_before_replace) : ''; ?>"/></td>

    </tr>   
    <tr>

        <td>Kết quả:</td>

        <td><input type="textfield" disabled="disable" name="n" size="30" value="<?php echo $kq; ?>"/></td>

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