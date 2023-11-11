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
$kq = "";
$soPhanTuA = 0;
$soPhanTuB = 0;
if (isset($_POST['mangA']) && isset($_POST['mangB'])) {
    $mangA = $_POST['mangA'];
    $mangB = $_POST['mangB'];

    $mangA = explode(",", $mangA);
    $mangB = explode(",", $mangB);

    $soPhanTuA = count($mangA);
    $soPhanTuB = count($mangB);

    $mangC = array_merge($mangA, $mangB);

    $mangCTangDan = sapXepMangTangDan($mangC);
    $mangCGiamDan = sapXepMangGiamDan($mangC);
}

?>

<form action="" method="post">
    <table>
        <th colspan="2"><h2>Gộp và Sắp xếp mảng</h2></th>
        <tr>
            <td>Nhập mảng A:</td>
            <td><input type="text" name="mangA" value="<?php echo isset($mangA) ? implode(",", $mangA) : ''; ?>"/></td>
        </tr>
        <tr>
            <td>Nhập mảng B:</td>
            <td><input type="text" name="mangB" value="<?php echo isset($mangB) ? implode(",", $mangB) : ''; ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="tinh" value="Thực hiện"/></td>
        </tr>
        <tr>
            <td>Số phần tử trong mảng A:</td>
            <td><input type="text" name="soPhanTuA" value="<?php echo $soPhanTuA; ?>" readonly/></td>
        </tr>
        <tr>
            <td>Số phần tử trong mảng B:</td>
            <td><input type="text" name="soPhanTuB" value="<?php echo $soPhanTuB; ?>" readonly/></td>
        </tr>
        <tr>
            <td>Mảng C:</td>
            <td><textarea name="mangC" rows="4" readonly><?php echo isset($mangC) ? implode(",", $mangC) : ''; ?></textarea></td>
        </tr>
        <tr>
            <td>Mảng C tăng dần:</td>
            <td><textarea name="mangCTangDan" rows="4" readonly><?php echo isset($mangCTangDan) ? implode(",", $mangCTangDan) : ''; ?></textarea></td>
        </tr>
        <tr>
            <td>Mảng C giảm dần:</td>
            <td><textarea name="mangCGiamDan" rows="4" readonly><?php echo isset($mangCGiamDan) ? implode(",", $mangCGiamDan) : ''; ?></textarea></td>
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