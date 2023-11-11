<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php 
    require("connect.php");

    $thongbao = '';
    if(isset($_POST['maNXB']))  
        $maNXB=trim($_POST['maNXB']); 
    else $maNXB='';
    if(isset($_POST['tenNXB']))  
        $tenNXB=trim($_POST['tenNXB']); 
    else $tenNXB='';
    if(isset($_POST['diaChi']))  
        $diaChi=trim($_POST['diaChi']); 
    else $diaChi='';
    if(isset($_POST['sdt']))  
        $sdt=trim($_POST['sdt']); 
    else $sdt='';
    
    function taoMaNXB() {
        GLOBAL $conn;
    
        $sql = "SELECT MAX(maNXB) AS maNXB_max FROM nhaxuatban";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maNXB_max"];
    
        $idNXB = intval(substr($idMax, 2)) + 1;
    
        $maNXB = "xb" . str_pad($idNXB, 3, "0", STR_PAD_LEFT);
    
        return $maNXB;
    }
    $maNXB = taoMaNXB();
    
    if (isset($_POST['them'])) {
        if($maNXB=='' || $tenNXB=='' || $diaChi=='' || $sdt=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else {
            $sql = "INSERT INTO nhaxuatban (maNXB, tenNXB, diaChi, sdt) VALUES ('$maNXB', '$tenNXB', '$diaChi', '$sdt')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $maNXB = taoMaNXB();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
    }
?>

<main>
    <p id='pageCaption'>THÊM NHÀ XUẤT BẢN</p>
    <form  action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã NXB:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maNXB" value="<?php echo $maNXB; ?>"/></td>
            </tr>
            <tr>
                <td>Tên NXB:</td>
                <td><input type="text" size=40 name="tenNXB" value=""/></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" size=40 name="diaChi" value=""/></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" size=20 name="sdt" value=""/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_NXB.php">Quay lại</a></p>
    </form>
</main>

 
<script>
    var tab = document.getElementById('hienthi_NXB');
    tab.classList.add('active');
</script>
<?php
include('../includes/footer.php');
?>