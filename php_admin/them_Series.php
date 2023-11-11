<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php 
    require("connect.php");

    $thongbao = '';
    if(isset($_POST['maSeries']))  
        $maSeries=trim($_POST['maSeries']); 
    else $maSeries='';
    if(isset($_POST['tenSeries']))  
        $tenSeries=trim($_POST['tenSeries']); 
    else $tenSeries='';
    
    function taoMaSeries() {
        GLOBAL $conn;

        $sql = "SELECT MAX(maSeries) AS maSeries_max FROM series";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maSeries_max"];

        $idSeries = intval(substr($idMax, 2)) + 1;

        $maSeries = str_pad($idSeries, 3, "0", STR_PAD_LEFT);

        return "ss" . $maSeries;
    }
    $maSeries= taoMaSeries();
    
    if (isset($_POST['them'])) {
        if($maSeries=='' || $tenSeries=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else {
            $sql = "INSERT INTO series (maSeries, tenSeries) VALUES ('$maSeries', '$tenSeries')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $maSeries = taoMaSeries();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
    }
?>

<main>
    <p id='pageCaption'>THÊM SERIES</p>
    <form  action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã series:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maSeries" value="<?php echo $maSeries; ?>"/></td>
            </tr>
            <tr>
                <td>Tên series:</td>
                <td><input type="text" size=40 name="tenSeries" value=""/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_Series.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_Series');
    tab.classList.add('active');
</script>
<?php
include('../includes/footer.php');
?>