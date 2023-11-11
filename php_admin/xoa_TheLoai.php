<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");	

    function xoaTheLoai($maTL) {
        global $conn;

        $query = "DELETE FROM theloai WHERE maTL = '$maTL'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maTL = $_GET['id'];
        if (isset($_POST['tenTL']))
            $tenTL = trim($_POST['tenTL']);
        else $tenTL = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaTheLoai($maTL);
            
            if ($kqXoa) {
                $maTL = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM theloai 
                WHERE maTL = '$maTL'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenTL = $row['tenTL'];
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ THỂ LOẠI</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã thể loại:</td>
                <td><input type="text" disabled size=20 name='maTL' value='<?php echo $maTL ?>'></td>
            </tr>
            <tr>
                <td>Tên thể loại:</td>
                <td><input type="text" disabled size=40 name='tenTL' value='<?php echo $tenTL ?>'></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
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