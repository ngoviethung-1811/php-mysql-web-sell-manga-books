<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/tim.css">

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
    else $vaiTro = 'all';
    if (isset($_POST['sdt']))
        $sdt = trim($_POST['sdt']);
    else $sdt = '';
    if (isset($_POST['dia-chi']))
        $diaChi = trim($_POST['dia-chi']);
    else $diaChi = '';
    if (isset($_POST['email']))
        $email = trim($_POST['email']);
    else $email = '';
?>

<main>
<?php
    require("connect.php");

    if ($vaiTro==='all')
        $txtVT = '';
    else $txtVT = "AND vaitro.maVT = '$vaiTro'";
    
    $query="SELECT nguoidung.*,vaitro.tenVT as vaitro FROM nguoidung
        JOIN vaitro ON nguoidung.maVT = vaitro.maVT
        WHERE hoTen like '%$tenND%'
        $txtVT
        AND sdt like '%$sdt%'
        AND diaChi like '%$diaChi%'
        AND email like '%$email'
        ORDER BY nguoidung.maND";
    $result = mysqli_query($conn,$query);

    echo "<p id='pageCaption'>TRA CỨU THÔNG TIN NGƯỜI DÙNG</p>";
    echo "<p align=center><a id='goback' href='javascript:window.history.back(-1);'>Quay lại</a></p>";
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
    else {
        echo "<tr><td colspan=7 align=center><font color=red>Không tìm thấy!</font></td></tr>";
    }
    echo"</table>";
?>
</main>

<script>
    var tab = document.getElementById('hienthi_NguoiDung');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>