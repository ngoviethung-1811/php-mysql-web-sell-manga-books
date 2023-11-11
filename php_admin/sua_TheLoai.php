<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $matl = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat'])) 
        {
            $tenTL = trim($_POST['tentl']);
            $sql = "UPDATE theloai SET tenTL = '$tenTL' 
                    WHERE maTL = '$matl'";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $tentl=$tenTL;
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM theloai 
                WHERE maTL = '$matl'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tentl=$row['tenTL'];
        } else {
            $tentl='';
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA THỂ LOẠI</p>
    <form  action="" method="post">
        <table >
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã thể loại:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="matl" value="<?php echo $matl; ?>"/></td>
            </tr>
            <tr>
                <td>Tên thể loại:</td>
                <td><input type="text" size=40 name="tentl" value="<?php echo $tentl; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_TheLoai.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_TheLoai');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>