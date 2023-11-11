<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/hienthi.css">

<?php
    if (isset($_POST['ten-truyen']))
        $tenTruyen = trim($_POST['ten-truyen']);
    else $tenTruyen = '';
    if (isset($_POST['the-loai']))
        $theLoai = trim($_POST['the-loai']);
    else $theLoai = '';
    if (isset($_POST['tac-gia']))
        $tacGia = trim($_POST['tac-gia']);
    else $tacGia = '';
    if (isset($_POST['series']))
        $series = trim($_POST['series']);
    else $series = '';
    if (isset($_POST['nxb']))
        $nxb = trim($_POST['nxb']);
    else $nxb = '';
?>

<main>
<?php
    require("connect.php");

    $rowsPerPage=10;
    if(!isset($_GET['page']))
    {
        $_GET['page']=1;
    }
    $offSet=($_GET['page']-1)*$rowsPerPage;
    $result = mysqli_query($conn, 'SELECT truyen.*,theloai.tenTL as theloai, series.tenSeries as series,
                            tacgia.tenTG as tacgia,nhaxuatban.tenNXB as nxb 
                            FROM truyen 
                            INNER JOIN theloai ON truyen.maTL = theloai.maTL 
                            INNER JOIN series ON truyen.maSeries = series.maSeries 
                            INNER JOIN tacgia ON truyen.maTG = tacgia.maTG
                            INNER JOIN nhaxuatban ON truyen.maNXB = nhaxuatban.maNXB
                            ORDER BY maTruyen  LIMIT ' . $offSet . ',' . $rowsPerPage);

    echo "<p id='pageCaption'>THÔNG TIN TRUYỆN</p>";
    echo '<p align=center><a id="btnThem" href="them_Truyen.php">Thêm truyện</a></p>';
    echo "<p align=center><button id='btnTimKiemForm' onclick='showSearchForm()'>Tìm kiếm</button></p>";

    echo "<form id='formTimKiem' action='tim_Truyen.php' method='post' style='display: none;'>
    <table id='tableTimKiem'>
        <tr>
            <td>Tên truyện:</td>
            <td><input type='text' id='ten-truyen' name='ten-truyen' value='$tenTruyen'></td>
        </tr>
        <tr>
            <td>Thể loại:</td>
            <td>
                <select name='the-loai'>
                    <option value='all' selected>Tất cả</option>";
                    $query = "SELECT maTL,tenTL FROM theloai";
                    $resultTL = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($resultTL)) {
                        echo '<option value="' . $row['maTL'] . '">' . $row['tenTL'] . '</option>';
                    }
    echo "      </select>
            </td>
        </tr>
        <tr>
            <td>Tác giả:</td>
            <td>
                <select name='tac-gia' >
                    <option value='all' selected>Tất cả</option>";
                    $query = "SELECT maTG,tenTG FROM tacgia";
                    $resultTG = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($resultTG)) {
                        echo '<option value="' . $row['maTG'] . '">' . $row['tenTG'] . '</option>';
                    }
    echo "      </select>
            </td>
        </tr>
        <tr>
            <td>Series:</td>
            <td>
                <select name='series' >
                    <option value='all' selected>Tất cả</option>";
                    $query = "SELECT maSeries,tenSeries FROM series";
                    $resultSeries = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($resultSeries)) {
                        echo '<option value="' . $row['maSeries'] . '">' . $row['tenSeries'] . '</option>';
                    }
    echo "      </select>
            </td>
        </tr>
        <tr>
            <td>Nhà xuất bản:</td>
            <td>
                <select name='nxb' >
                    <option value='all' selected>Tất cả</option>";
                    $query = "SELECT maNXB,tenNXB FROM nhaxuatban";
                    $resultNXB = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($resultNXB)) {
                        echo '<option value="' . $row['maNXB'] . '">' . $row['tenNXB'] . '</option>';
                    }
    echo "      </select>
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center>
                <input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='hideSearchForm()'/>
                <input type='submit' name='tim' value='Tìm' id='btnTim'>
                <input type='reset' name='reset' value='Làm mới' id='btnReset'>
            </td>
        </tr>
    </table>
    </form>";

    echo "<table border='1'>";
    echo '<tr>
        <th>Mã truyện</th>
        <th>Tên truyện</th>
        <th>Thể loại</th>
        <th>Tên tác giả</th>
        <th>Series</th>
        <th>Nhà xuất bản</th>
        <th>Thao tác</th>
    </tr>';

    if(mysqli_num_rows($result) <> 0)
    {	 
        $stt=1;
        while($rows=mysqli_fetch_assoc($result))
        {          
            if ($stt%2==0) echo "<tr style='background-color: #b9e7f0;'>";
            else echo "<tr>";
            echo "<td class='centerText'>" . $rows['maTruyen'] . "</td>";
            echo "<td>" . $rows['tenTruyen'] . "</td>";
            echo "<td>" . $rows['theloai'] . "</td>";            
            echo "<td>" . $rows['tacgia'] . "</td>";
            echo "<td>" . $rows['series'] . "</td>";
            echo "<td>" . $rows['nxb'] . "</td>";
            echo "<td><a title='Xem chi tiết' href='xem_Truyen.php?id=" . $rows['maTruyen'] . "'><img style='height:1rem;' src='../images/icon_details.png'/></a> ";
            echo "<a title='Sửa' href='sua_Truyen.php?id=" . $rows['maTruyen'] . "'><img style='height:1rem;' src='../images/icon_edit.png'/></a> ";
            echo "<a title='Xoá' href='xoa_Truyen.php?id=" . $rows['maTruyen'] . "'><img style='height:1rem;' src='../images/icon_delete.png'/></a> ";
            echo "</td>";
            echo "</tr>";

            $stt+=1;
        }

    }
    else
    {
        echo "<tr><td colspan='7'>Không có bản ghi</td></tr>";
    }
    echo"</table>";

    $re = mysqli_query($conn, 'select * from truyen');
    $numRows = mysqli_num_rows($re); 
    $maxPage = ceil($numRows/$rowsPerPage);

    echo "<br>";
    echo "<div style='text-align: center; margin: 0.2rem;'>";
    echo "<div class='pagination'>";
    if ($_GET['page'] > 1) {
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
    }
    else {
        echo "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
        echo "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
    }
    for ($i=1 ; $i<=$maxPage ; $i++){ 
        if ($i == $_GET['page'])
            echo "<a class='active'>".$i."</a>";
        else
            echo "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">".$i."</a>";
    }
    if ($_GET['page'] < $maxPage) {
        echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
    }
    else {
        echo "<a class='disable' href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
        echo "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
    }
    echo '</div>';
    echo '</div>';
?>
</main>

<script>
    var tab = document.getElementById('hienthi_Truyen');
    tab.classList.add('active');
</script>
<script src="../javascript/hienthi_form_timkiem.js"></script>

<?php
    include('../includes/footer.php');
?>