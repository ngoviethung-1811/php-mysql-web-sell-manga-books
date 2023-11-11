<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");	

    function xoaLKM($maLKM) {
        global $conn;

        $query = "DELETE FROM loaikhuyenmai WHERE maLKM='$maLKM'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maLKM = $_GET['id'];
        if (isset($_POST['tenLKM']))
            $tenLKM = trim($_POST['tenLKM']);
        else $tenLKM = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaLKM($maLKM);
            
            if ($kqXoa) {
                $maLKM = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM loaikhuyenmai 
                WHERE maLKM='$maLKM'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenLKM = $row['tenLKM'];
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ LOẠI KHUYẾN MÃI</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã LKM:</td>
                <td><input type="text" disabled size=20 name='maLKM' value='<?php echo $maLKM ?>'></td>
            </tr>
            <tr>
                <td>Tên LKM:</td>
                <td><input type="text" disabled size=40 name='tenLKM' value='<?php echo $tenLKM ?>'></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_LKM.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_LKM');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>