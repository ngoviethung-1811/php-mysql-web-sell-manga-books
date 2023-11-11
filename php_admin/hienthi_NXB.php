<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/hienthi.css">

<?php
$conn = mysqli_connect('localhost', 'root', '', 'qlbantruyentranh')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
if (isset($_POST['ma_NXB']))
    $maNXB = trim($_POST['ma_NXB']);
else
    $maNXB = '';
if (isset($_POST['ten_NXB']))
    $tenNXB = trim($_POST['ten_NXB']);
else
    $tenNXB = '';
if (isset($_POST['diachi_NXB']))
    $diachiNXB = trim($_POST['diachi_NXB']);
else
    $diachiNXB = '';
if (isset($_POST['sdt']))
    $sdt = trim($_POST['sdt']);
else
    $sdt = '';


$rowsPerPage = 10;
if (!isset($_GET['page']))
    $_GET['page'] = 1;
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$query = "SELECT * FROM nhaxuatban";
$result = $conn->query($query);
$re = mysqli_query($conn, 'select * from nhaxuatban');
$numRows = mysqli_num_rows($re);
$maxPage = ceil($numRows / $rowsPerPage);

$phanTrang = "";

if ($_GET['page'] > 1) {
    $phanTrang .= "<a href=" . $_SERVER['PHP_SELF'] . "?page=1> << </a>";
    $phanTrang .= "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "> < </a>";
} else {
    $phanTrang .= "<a class='disable' href=" . $_SERVER['PHP_SELF'] . "?page=1> << </a>";
    $phanTrang .= "<a class='disable' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "> < </a>";
}
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['page'])
        $phanTrang .= "<a class='active'>" . $i . "</a>";
    else
        $phanTrang .= "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">" . $i . "</a>";
}
if ($_GET['page'] < $maxPage) {
    $phanTrang .= "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . "> > </a>";
    $phanTrang .= "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . "> >> </a>";
} else {
    $phanTrang .= "<a class='disable' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . "> > </a>";
    $phanTrang .= "<a class='disable' href=" . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . "> >> </a>";
}
?>

<main>
    <p id='pageCaption'>THÔNG TIN NHÀ XUẤT BẢN</p>

    <p align=center><a id="btnThem" href="them_NXB.php">Thêm nhà xuất bản</a></p>

    <table border=1>
        <tr>
            <th>Mã NXB</th>
            <th>Tên NXB</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Thao tác</th>
        </tr>

        <?php
        $stt=1;
        while ($row = $result->fetch_assoc()) {
            if ($stt%2==0) echo "<tr style='background-color: #b9e7f0;'>";
            else echo "<tr>";
            echo "<td class='centerText'>" . $row['maNXB'] . "</td>";
            echo "<td>" . $row['tenNXB'] . "</td>";
            echo "<td>" . $row['diaChi'] . "</td>";
            echo "<td>" . $row['sdt'] . "</td>";
            echo "<td><a title='Sửa' href='sua_NXB.php?id=" . $row['maNXB'] . "'><img style='height:1rem;' src='../images/icon_edit.png'/></a>   <a title='Xoá' href='xoa_NXB.php?id=" . $row['maNXB'] . "'><img style='height:1rem;' src='../images/icon_delete.png'/></a></td>";
            echo "</tr>";
            $stt++;
        }
        ?>

    </table>
    <div style='text-align: center; margin: 0.2rem;'>
        <div class='pagination'>
            <?php echo $phanTrang; ?>
        </div>
    </div>
</main>

<script>
    var tab = document.getElementById('hienthi_NXB');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>