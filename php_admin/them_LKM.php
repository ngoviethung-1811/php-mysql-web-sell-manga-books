<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php 
    require("connect.php");

    $thongbao = '';
    if(isset($_POST['maLKM']))  
        $maLKM=trim($_POST['maLKM']); 
    else $maLKM='';
    if(isset($_POST['tenLKM']))  
        $tenLKM=trim($_POST['tenLKM']); 
    else $tenLKM='';
    
    function taoMaLKM() {
        GLOBAL $conn;
    
        $sql = "SELECT MAX(maLKM) AS maLKM_max FROM LoaiKhuyenMai";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maLKM_max"];
    
        $idLKM = intval(substr($idMax, 3)) + 1;
    
        $maLKM = "lkm" . str_pad($idLKM, 2, "0", STR_PAD_LEFT);
       
        return $maLKM;
    }
    $maLKM= taoMaLKM();
    
    if (isset($_POST['them'])) {
        if($maLKM=='' || $tenLKM=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else {
            $sql = "INSERT INTO loaikhuyenmai (maLKM, tenLKM) VALUES ('$maLKM', '$tenLKM')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $maLKM = taoMaLKM();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
    }
?>

<main>
    <p id='pageCaption'>THÊM LOẠI KHUYẾN MÃI</p>
    <form  action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã LKM:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maLKM" value="<?php echo $maLKM; ?>"/></td>
            </tr>
            <tr>
                <td>Tên LKM:</td>
                <td><input type="text" size=40 name="tenLKM" value=""/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_LKM.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_LKM');
    tab.classList.add('active');
</script>
<?php
include('../includes/footer.php');
?>