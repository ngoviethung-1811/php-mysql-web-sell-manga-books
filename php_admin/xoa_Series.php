<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");	

    function xoaSeries($maSeries) {
        global $conn;

        $query = "DELETE FROM series WHERE maSeries='$maSeries'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maSeries = $_GET['id'];
        if (isset($_POST['tenSeries']))
            $tenSeries = trim($_POST['tenSeries']);
        else $tenSeries = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaSeries($maSeries);
            
            if ($kqXoa) {
                $maSeries = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM series 
                WHERE maSeries = '$maSeries'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenSeries = $row['tenSeries'];
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ SERIES</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã series:</td>
                <td><input type="text" disabled size=20 name='maSeries' value='<?php echo $maSeries ?>'></td>
            </tr>
            <tr>
                <td>Tên series:</td>
                <td><input type="text" disabled size=40 name='tenSeries' value='<?php echo $tenSeries ?>'></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
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