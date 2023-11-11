<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xoa.css">

<?php
    require("connect.php");	

    function xoaPTVC($maPTVC) {
        global $conn;

        $query = "DELETE FROM ptvanchuyen WHERE maPTVC = '$maPTVC'";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    if (isset($_GET['id'])) {
        $maPTVC = $_GET['id'];
        if (isset($_POST['tenPTVC']))
            $tenPTVC = trim($_POST['tenPTVC']);
        else $tenPTVC = '';

        $thongbao = '';
        $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='history.back()'/>
        <input type='submit' value='Xoá' name='xoa' id='btnXoa'/>";

        if (isset($_POST['xoa'])) {
            $kqXoa = xoaPTVC($maPTVC);
            
            if ($kqXoa) {
                $maPTVC = '';
                $thongbao = "<p align=center><font color=green>Xoá thành công!</font></p>";
                $buttons = "<input type='button' value='Huỷ' name='huy' id='btnHuy' class='disable' onclick='history.back()'/>
                <input type='submit' value='Xoá' name='xoa' id='btnXoa' class='disable'/>";
            }
            else $thongbao = "<p align=center><font color=red>Xoá không thành công!</font></p>";
        }

        $query = "SELECT * 
                FROM ptvanchuyen 
                WHERE maPTVC = '$maPTVC'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tenPTVC = $row['tenPTVC'];
        }
    } 
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XOÁ PHƯƠNG THỨC VẬN CHUYỂN</p>
    <form action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã PTVC:</td>
                <td><input type="text" disabled size=20 name='maPTVC' value='<?php echo $maPTVC ?>'></td>
            </tr>
            <tr>
                <td>Tên PTVC:</td>
                <td><input type="text" disabled size=40 name='tenPTVC' value='<?php echo $tenPTVC ?>'></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <?php echo $buttons; ?>
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