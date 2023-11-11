<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $maPTVC = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat'])) 
        {
            $tenPTVC = trim($_POST['tenPTVC']);
            $sql = "UPDATE ptvanchuyen SET tenPTVC='$tenPTVC' WHERE maPTVC='$maPTVC'";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * FROM ptvanchuyen WHERE maPTVC='$maPTVC'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenPTVC=$row['tenPTVC'];
        } else {
            $tenPTVC='';
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA PHƯƠNG THỨC VẬN CHUYỂN</p>
    <form  action="" method="post">
        <table >
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã PTVC:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maPTVC" value="<?php echo $maPTVC; ?>"/></td>
            </tr>
            <tr>
                <td>Tên PTVC:</td>
                <td><input type="text" size=40 name="tenPTVC" value="<?php echo $tenPTVC; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
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