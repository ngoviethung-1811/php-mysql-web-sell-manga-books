<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<style>
    table {
        background: #b8cef2;
        border: 0 solid yellow;
        width: 500px;
    }

    thead {
        background: #2971e6;
    }

    td {
        text-align: center;
    }

    h3 {
        font-family: verdana;
        text-align: center;
        color: white;
        font-size: medium;
    }

    input[type="text"], input[type="submit"] {
        padding: 5px;
        width: 100%;
    }
</style>

<?php
if (isset($_POST['nam_dl']))
    $nam_dl = trim($_POST['nam_dl']);
else $nam_dl = '';
if (isset($_POST['nam_al']))
    $nam_al = trim($_POST['nam_al']);
else $nam_al = '';
if (isset($_POST['hinh_anh']))
    $hinh_anh = trim($_POST['hinh_anh']);
else $hinh_anh = '';

if (isset($_POST['tinh'])) {
    if (is_numeric($nam_dl)) {
        if ($nam_dl <= 2) {
            echo "<font color='red'>Vui lòng nhập năm lớn hơn 2! </font>";
            $nam_al = '';
            $hinh_anh = '';
        } else {
            $mang_can = array("Quý", "Giáp", "Ất", "Bình", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm");
            $mang_chi = array("Hợi", "Tý", "Sửu", "Dần", "Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất");
            $mang_hinh = array("hoi.jpg", "chuot.jpg", "suu.jpg", "dan.jpg", "meo.jpg", "thin.jpg", "ty.jpg", "ngo.jpg", "mui.jpg", "than.jpg", "dau.jpg", "tuat.jpg");

            $nam = $nam_dl - 3;
            $can = $nam % 10;
            $chi = $nam % 12;
            $nam_al = $mang_can[$can] . " " . $mang_chi[$chi];
            $hinh = $mang_hinh[$chi];
            $hinh_anh = "<img src='images/Hinh_con_giap/$hinh' style='height:150px;'>";
        }
    } else {
        echo "<font color='red'>Vui lòng nhập vào số! </font>";
        $nam_al = '';
        $hinh_anh = '';
    }
} else {
    $nam_al = '';
    $hinh_anh = '';
}
?>

<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="3" align="center"><h3>TÍNH NĂM ÂM LỊCH</h3></th>
        </thead>
        <tr>
            <td>Năm dương lịch</td>
            <td></td>
            <td>Năm âm lịch</td>
        </tr>
        <tr>
            <td><input type="text" name="nam_dl" value="<?php echo $nam_dl; ?>" /></td>
            <td><input type="submit" value="->" name="tinh" /></td>
            <td><input type="text" name="nam_al" value="<?php echo $nam_al; ?>" disabled="disabled" /></td>
        </tr>
        <tr>
            <td colspan="3" style="height: 170px"><?php echo $hinh_anh; ?></td>
        </tr>
    </table>
</form>

</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>