<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php 
    require("connect.php");

    $thongbao = '';
    if(isset($_POST['maTG']))  
        $maTG=trim($_POST['maTG']); 
    else $maTG='';
    if(isset($_POST['tenTG']))  
        $tenTG=trim($_POST['tenTG']); 
    else $tenTG='';
    
    function taoMaTacGia() {
        GLOBAL $conn;
    
        $sql = "SELECT MAX(maTG) AS maTG_max FROM tacgia";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maTG_max"];
    
        $idTacGia = intval(substr($idMax, 2)) + 1;
    
        $maTG = str_pad($idTacGia, 3, "0", STR_PAD_LEFT);
    
        return "tg" . $maTG;
    }
    $maTG= taoMaTacGia();
    
    if (isset($_POST['them'])) {
        if($maTG=='' || $tenTG=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else {
            $sql = "INSERT INTO tacgia (maTG, tenTG) VALUES ('$maTG', '$tenTG')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $maTG = taoMaTacGia();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
    }
?>

<main>
    <p id='pageCaption'>THÊM TÁC GIẢ</p>
    <form  action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã tác giả:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maTG" value="<?php echo $maTG; ?>"/></td>
            </tr>
            <tr>
                <td>Tên tác giả:</td>
                <td><input type="text" size=40 name="tenTG" value=""/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_TacGia.php">Quay lại</a></p>
    </form>
</main>
    
<script>
    var tab = document.getElementById('hienthi_TacGia');
    tab.classList.add('active');
</script>
<?php
include('../includes/footer.php');
?>