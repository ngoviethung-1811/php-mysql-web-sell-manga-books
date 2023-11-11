<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/tim.css">

<?php
if (isset($_POST['ten-truyen']))
    $tenTruyen = $_POST['ten-truyen'];
else $tenTruyen = '';
if (isset($_POST['tac-gia']))
    $tenTacGia = $_POST['tac-gia'];
else $tenTacGia = 'all';
if (isset($_POST['the-loai']))
    $tenTheLoai = $_POST['the-loai'];
else $tenTheLoai = 'all';
if (isset($_POST['series']))
    $tenSeries = $_POST['series'];
else $tenSeries = 'all';
if (isset($_POST['nxb']))
    $nxb = $_POST['nxb'];
else $nxb = 'all';
?>

<main>
<?php
    require("connect.php");

    if ($tenTheLoai==='all')
        $txtTL = '';
    else $txtTL = "AND theloai.maTL = '$tenTheLoai'";
    if ($tenTacGia==='all')
        $txtTG = '';
    else $txtTG = "AND tacgia.maTG = '$tenTacGia'";
    if ($tenSeries==='all')
        $txtSeries = '';
    else $txtSeries = "AND series.maSeries = '$tenSeries'";
    if ($nxb==='all')
        $txtNXB = '';
    else $txtNXB = "AND nhaxuatban.maNXB = '$nxb'";

    $query="SELECT truyen.*,theloai.tenTL as theloai,series.tenSeries as series,tacgia.tenTG as tacgia,
            nhaxuatban.tenNXB as nxb FROM truyen
            INNER JOIN tacgia ON truyen.maTG = tacgia.maTG
            INNER JOIN theloai ON truyen.maTL = theloai.maTL
            INNER JOIN nhaxuatban ON truyen.maNXB = nhaxuatban.maNXB
            INNER JOIN series ON truyen.maSeries = series.maSeries
            WHERE tenTruyen like'%$tenTruyen%'
            $txtTL $txtTG $txtSeries $txtNXB
            ORDER BY maTruyen";
    $result = mysqli_query($conn,$query);

    echo "<p id='pageCaption'>TRA CỨU THÔNG TIN TRUYỆN</p>";
    echo "<p align=center><a id='goback' href='javascript:window.history.back(-1);'>Quay lại</a></p>";
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
        echo "<tr><td colspan=7 align=center><font color=red>Không tìm thấy!</font></td></tr>";
    }
    echo"</table>";
?>
</main>

<script>
    var tab = document.getElementById('hienthi_Truyen');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>