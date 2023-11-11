<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/hienthi.css">

<style>
    table {
        width: 50%;
    }
</style>

<main>
<?php
    require("connect.php");

    $rowsPerPage=10;
    if(!isset($_GET['page']))	
    {
        $_GET['page']=1;
    }
    $offSet=($_GET['page']-1)*$rowsPerPage;
    $result = mysqli_query($conn, 'select maTL,tenTL FROM theloai ORDER BY maTL LIMIT ' . $offSet . ',' . $rowsPerPage);

    echo "<p id='pageCaption'>THÔNG TIN THỂ LOẠI</p>";
    echo '<p align=center><a id="btnThem" href="them_TheLoai.php">Thêm thể loại</a></p>';

    echo "<table border='1'>";
    echo '<tr>
        <th>Mã thể loại</th>
        <th>Tên thể loại</th>
        <th>Thao tác</th>
    </tr>';

    if(mysqli_num_rows($result) > 0)
    {	 
        $stt=1;
        while($rows=mysqli_fetch_assoc($result))
        {          
            if ($stt%2==0) echo "<tr style='background-color: #b9e7f0;'>";
            else echo "<tr>";
            echo "<td class='centerText'>" . $rows['maTL'] . "</td>";
            echo "<td>" . $rows['tenTL'] . "</td>";
            echo "<td>";
            echo "<a title='Sửa' href='sua_TheLoai.php?id=" . $rows['maTL'] . "'><img style='height:1rem;' src='../images/icon_edit.png'/></a> ";
            echo "<a title='Xoá' href='xoa_TheLoai.php?id=" . $rows['maTL'] . "'><img style='height:1rem;' src='../images/icon_delete.png'/></a> ";
            echo "</td>";
            echo "</tr>";
            $stt+=1;
        }
    }
    else
    {
        echo "<tr><td colspan='3'>Không có bản ghi</td></tr>";
    }
    echo"</table>";

    $re = mysqli_query($conn, 'select * from theloai');
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
    var tab = document.getElementById('hienthi_TheLoai');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>