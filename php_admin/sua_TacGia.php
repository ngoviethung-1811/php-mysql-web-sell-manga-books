<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $maTG = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat'])) 
        {
            $tenTG = trim($_POST['tenTG']);
            $sql = "UPDATE tacgia SET tenTG='$tenTG' WHERE maTG='$maTG'";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * FROM tacgia WHERE maTG='$maTG'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenTG=$row['tenTG'];
        } else {
            $tenTG='';
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA TÁC GIẢ</p>
    <form  action="" method="post">
        <table >
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã tác giả:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maTG" value="<?php echo $maTG; ?>"/></td>
            </tr>
            <tr>
                <td>Tên tác giả:</td>
                <td><input type="text" size=40 name="tenTG" value="<?php echo $tenTG; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
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