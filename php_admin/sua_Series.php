<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $maSeries = $_GET['id'];
        $thongbao = '';

        if(isset($_POST['capnhat'])) 
        {
            $tenSeries = trim($_POST['tenSeries']);
            $sql = "UPDATE series SET tenSeries='$tenSeries' WHERE maSeries='$maSeries'";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
            }
            else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
        }

        $query = "SELECT * FROM series WHERE maSeries='$maSeries'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenSeries=$row['tenSeries'];
        } else {
            $tenSeries='';
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>SỬA SERIES</p>
    <form  action="" method="post">
        <table >
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã series:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="maSeries" value="<?php echo $maSeries; ?>"/></td>
            </tr>
            <tr>
                <td>Tên series:</td>
                <td><input type="text" size=40 name="tenSeries" value="<?php echo $tenSeries; ?>"/></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
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