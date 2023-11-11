<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php 
    require("connect.php");

    $thongbao = '';
    if(isset($_POST['maPTVC']))  
        $maPTVC=trim($_POST['maPTVC']); 
    else $maPTVC='';
    if(isset($_POST['tenPTVC']))  
        $tenPTVC=trim($_POST['tenPTVC']); 
    else $tenPTVC='';
    
    function taoMaPTVC() {
        GLOBAL $conn;
    
        $sql = "SELECT MAX(maPTVC) AS maPTVC_max FROM ptvanchuyen";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maPTVC_max"];
    
        $idPTVC = intval(substr($idMax, 2)) + 1;
    
        $maPTVC = str_pad($idPTVC, 3, "0", STR_PAD_LEFT);
    
        return "vc" . $maPTVC;
    }
    $maPTVC= taoMaPTVC();
    
    if (isset($_POST['them'])) {
        if($maPTVC=='' || $tenPTVC=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else {
            $sql = "INSERT INTO ptvanchuyen (maPTVC, tenPTVC) VALUES ('$maPTVC', '$tenPTVC')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $maPTVC = taoMaPTVC();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
    }
?>

<main>
    <p id='pageCaption'>THÊM PHƯƠNG THỨC VẬN CHUYỂN</p>
    <form  action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã PTVC:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maPTVC" value="<?php echo $maPTVC; ?>"/></td>
            </tr>
            <tr>
                <td>Tên PTVC:</td>
                <td><input type="text" size=40 name="tenPTVC" value=""/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_PTVC.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_PTVC');
    tab.classList.add('active');
</script>
<?php
include('../includes/footer.php');
?>