<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");	

    function xoaTacGia($maTG) {
        global $conn;

        $query = "DELETE FROM tacgia WHERE maTG='$maTG'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maTG = $_GET['id'];
        if (isset($_POST['tenTG']))
            $tenTG = trim($_POST['tenTG']);
        else $tenTG = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaTacGia($maTG);
            
            if ($kqXoa) {
                $maTG = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM tacgia 
                WHERE maTG = '$maTG'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenTG = $row['tenTG'];
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ TÁC GIẢ</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã tác giả:</td>
                <td><input type="text" disabled size=20 name='maTG' value='<?php echo $maTG ?>'></td>
            </tr>
            <tr>
                <td>Tên tác giả:</td>
                <td><input type="text" disabled size=40 name='tenTG' value='<?php echo $tenTG ?>'></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
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