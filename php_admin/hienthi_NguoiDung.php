<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/hienthi.css">

<?php
    if ($_SESSION['user']['role']!='admin'){
        header('Location: ../html/permission_denied.html');
        exit();
    }
?>

<?php
    if (isset($_POST['ten-nd']))
    $tenND = trim($_POST['ten-nd']);
    else $tenND = '';
    if (isset($_POST['vai-tro']))
    $vaiTro = trim($_POST['vai-tro']);
    else $vaiTro = '';
    if (isset($_POST['email']))
    $email = trim($_POST['email']);
    else $email = '';
    if (isset($_POST['dia-chi']))
    $diaChi = trim($_POST['dia-chi']);
    else $diaChi = '';
    if (isset($_POST['sdt']))
    $sdt = trim($_POST['sdt']);
    else $sdt = '';
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
    $result = mysqli_query($conn, 'select nguoidung.*,vaitro.tenVT as vaitro FROM nguoidung 
    INNER JOIN vaitro ON nguoidung.maVT = vaitro.maVT ORDER BY nguoidung.maND LIMIT ' . $offSet . ',' . $rowsPerPage);

    echo "<p id='pageCaption'>THÔNG TIN NGƯỜI DÙNG</p>";
    echo '<p align=center><a id="btnThem" href="them_NguoiDung.php">Thêm người dùng</a></p>';
    echo "<p align=center><button id='btnTimKiemForm' onclick='showSearchForm()'>Tìm kiếm</button></p>";

    echo "<form id='formTimKiem' action='tim_NguoiDung.php' method='post' style='display: none;'>
    <table id='tableTimKiem'>
        <tr>
            <td>Tên người dùng:</td>
            <td><input type='text' name='ten-nd' size=40 value='$tenND'></td>
        </tr>
        <tr>
            <td>Vai trò:</td>
            <td>
                <select name='vai-tro' >
                    <option value='all' selected>Tất cả</option>";
                    $query = "SELECT maVT,tenVT FROM vaitro";
                    $resultVaiTro = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($resultVaiTro)) {
                        echo '<option value="' . $row['maVT'] . '">' . $row['tenVT'] . '</option>';
                    }
    echo "      </select>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type='text' name='email' size=40 value='$email'></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type='text' name='dia-chi' size=40 value='$diaChi'></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type='text' name='sdt' size=20 value='$sdt'></td>
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
        <th>Mã người dùng</th>
        <th>Tên người dùng</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
        <th>Vai trò</th>
        <th>Thao tác</th>
    </tr>';

    if(mysqli_num_rows($result) <> 0)
    {	 
        $stt=1;
        while($rows=mysqli_fetch_assoc($result))
        {          
            if ($stt%2==0) echo "<tr style='background-color: #b9e7f0;'>";
            else echo "<tr>";
            echo "<td class='centerText'>" . $rows['maND'] . "</td>";
            echo "<td>" . $rows['hoTen'] . "</td>";
            echo "<td>" . $rows['email'] . "</td>";
            echo "<td>" . $rows['diaChi'] . "</td>";
            echo "<td>" . $rows['sdt'] . "</td>";
            echo "<td>" . $rows['vaitro'] . "</td>";
            echo "<td><a title='Xem chi tiết' href='xem_NguoiDung.php?id=" . $rows['maND'] . "'><img style='height:1rem;' src='../images/icon_details.png'/></a> ";
            echo "<a title='Sửa' href='sua_NguoiDung.php?id=" . $rows['maND'] . "'><img style='height:1rem;' src='../images/icon_edit.png'/></a> ";
            echo "<a title='Xoá' href='xoa_NguoiDung.php?id=" . $rows['maND'] . "'><img style='height:1rem;' src='../images/icon_delete.png'/></a> ";
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

    $re = mysqli_query($conn, 'select * from nguoidung');
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
    var tab = document.getElementById('hienthi_NguoiDung');
    tab.classList.add('active');
</script>
<script src="../javascript/hienthi_form_timkiem.js"></script>

<?php
include('../includes/footer.php');
?>