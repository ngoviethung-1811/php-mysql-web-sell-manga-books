<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/hienthi.css">

<style>
    table {
        width: 50%;
    }
</style>

<?php
    require("connect.php");
    $rowsPerPage = 10;
    if (isset($_POST['ma_PTVC']))
        $maPTVC = trim($_POST['ma_PTVC']);
    else
        $maPTVC = '';
    if (isset($_POST['ten_PTVC']))
        $tenPTVC = trim($_POST['ten_PTVC']);
    else
        $tenPTVC = '';
    if (!isset($_GET['page']))
        $_GET['page'] = 1;
    $offset = ($_GET['page'] - 1) * $rowsPerPage;
    $query = "SELECT * FROM ptvanchuyen";
    $result = $conn->query($query);
    $re = mysqli_query($conn, 'select * from ptvanchuyen');
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
    <p id='pageCaption'>THÔNG TIN PHƯƠNG THỨC VẬN CHUYỂN</p>

    <p align=center><a id="btnThem" href="them_PTVC.php">Thêm phương thức vận chuyển</a></p>


    <table border=1>
        <tr>
            <th>Mã PTVC</th>
            <th>Tên PTVC</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $stt=1;
            while ($row = $result->fetch_assoc()) {
                if ($stt%2==0) echo "<tr style='background-color: #b9e7f0;'>";
                else echo "<tr>";
                echo "<td class='centerText'>" . $row['maPTVC'] . "</td>";
                echo "<td>" . $row['tenPTVC'] . "</td>";
                echo "<td><a title='Sửa' href='sua_PTVC.php?id=" . $row['maPTVC'] . "'><img style='height:1rem;' src='../images/icon_edit.png'/></a>   <a title='Xoá' href='xoa_PTVC.php?id=" . $row['maPTVC'] . "'><img style='height:1rem;' src='../images/icon_delete.png'/></a></td>";
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
    var tab = document.getElementById('hienthi_PTVC');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>