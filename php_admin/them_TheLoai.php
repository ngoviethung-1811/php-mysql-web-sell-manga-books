<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php
    require("connect.php");

    function taoMaTL() {
        GLOBAL $conn;

        $sql = "SELECT MAX(maTL) AS maTL_max FROM theloai";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maTL_max"];

        $idTL = intval(substr($idMax, 2)) + 1;

        $TL = str_pad($idTL, 3, "0", STR_PAD_LEFT);

        return "tl" . $TL;
    }

    $matl = taoMaTL();
    $thongbao = '';

    if(isset($_POST['tentl']))  
        $tentl=trim($_POST['tentl']); 
    else $tentl = '';

    if(isset($_POST['them']))
    {
        if($tentl=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else
        {
            $sql = "INSERT INTO theloai (maTL, tenTL) VALUES ('$matl', '$tentl')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $matl = taoMaTL();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
        
    }
?>

<main>
    <p id='pageCaption'>THÊM THỂ LOẠI</p>
    <form  action="" method="post" >
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã thể loại:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="matl" value="<?php echo $matl; ?>"/></td>
            </tr>
            <tr>
                <td>Tên thể loại:</td>
                <td><input type="text" size=40 name="tentl" value=""/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
    </form>
    <p align=center><a id="goback" href="./hienthi_TheLoai.php">Quay lại</a></p>
</main>

<script>
    var tab = document.getElementById('hienthi_TheLoai');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>