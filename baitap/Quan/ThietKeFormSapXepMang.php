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
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        table {
            width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: gray;
            color: #ffff00;
        }
        th {
            background-color: blue;
            color: yellow;
        }
        h2 {
            text-align: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 5px;
            background-color: #cccc00;
            border: none;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d3d300;
        }
        textarea {
            width: 100%;
            resize: none;
        }
    </style>
<?php
function sapXepMangTangDan($m)
{
    sort($m);
    return $m;
}

function sapXepMangGiamDan($m)
{
    rsort($m);
    return $m;
}
?>

<?php 
$kqTangDan = "";
$kqGiamDan = "";
if (isset($_POST['mang']))
    $mang = $_POST['mang'];
else 
    $mang = "";
if (isset($_POST['sapXep'])) {
    $m = explode(",", $mang);
    $mTangDan = sapXepMangTangDan($m);
    $mGiamDan = sapXepMangGiamDan($m);
    $kqTangDan = implode(",", $mTangDan);
    $kqGiamDan = implode(",", $mGiamDan);
}
?>

<form action="" method="post">
<table border="0" cellpadding="0">
    <th colspan="2"><h2>Sắp xếp mảng</h2></th>
    <tr>
        <td>Nhập mảng:</td>
        <td><input type="text" name="mang" size="40" value="<?php echo $mang; ?>"/></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="sapXep" size="20" value="Sắp xếp và hiển thị kết quả"/></td>
    </tr>
    <tr>
        <td>Kết quả tăng dần:</td>
        <td><textarea name="ketqua_tangdan" rows="4" cols="50" readonly><?php echo $kqTangDan; ?></textarea></td>
    </tr>
    <tr>
        <td>Kết quả giảm dần:</td>
        <td><textarea name="ketqua_giamdan" rows="4" cols="50" readonly><?php echo $kqGiamDan; ?></textarea></td>
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