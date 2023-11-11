<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/xem.css">

<?php
    require("connect.php");

    if (isset($_GET['id'])) {
        $maTruyen = $_GET['id'];

        $query = "SELECT truyen.*,theloai.tenTL as theloai,series.tenSeries as series,tacgia.tenTG as tacGia,nhaxuatban.tenNXB as nxb 
                FROM truyen 
                INNER JOIN theloai ON truyen.maTL = theloai.maTL 
                INNER JOIN series ON truyen.maSeries = series.maSeries 
                INNER JOIN tacgia ON truyen.maTG = tacgia.maTG
                INNER JOIN nhaxuatban ON truyen.maNXB = nhaxuatban.maNXB 
                WHERE maTruyen = '$maTruyen'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)<>0) {
            while($rows=mysqli_fetch_assoc($result)) {
                $tenTruyen = $rows['tenTruyen'];
                $tacGia = $rows['tacGia'];
                $theLoai = $rows['theloai'];
                $series = $rows['series'];
                $moTa = $rows['moTa'];
                $nxb = $rows['nxb'];
                $ngayPH = $rows['ngayPhatHanh'];
                $soTrang = $rows['soTrang'];
                $ngonNgu = $rows['ngonNgu'];
                $donGia = number_format($rows['donGia'], 0, ",", ".") . "đ";
                $soLuongTon = $rows['soLuongTon'];
                $anhBia = $rows['anhBia'];
            }
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <p id='pageCaption'>XEM CHI TIẾT TRUYỆN</p>
    <table>
        <tr>
            <td colspan=2 align=center>
                <img style="height:20rem;" src="../images/<?php echo $anhBia ?>" alt="anhbia">
            </td>
        </tr>
        <tr>
            <td>Mã truyện:</td>
            <td><input type="text" disabled size=20 name='maTruyen' value='<?php echo $maTruyen ?>'></td>
        </tr>
        <tr>
            <td>Tên truyện:</td>
            <td><input type="text" disabled size=40 name='tenTruyen' value='<?php echo $tenTruyen ?>'></td>
        </tr>
        <tr>
            <td>Tác giả:</td>
            <td><input type="text" disabled size=40 name='tacGia' value='<?php echo $tacGia ?>'></td>
        </tr>
        <tr>
            <td>Thể loại:</td>
            <td><input type="text" disabled size=20 name='theLoai' value='<?php echo $theLoai ?>'></td>
        </tr>
        <tr>
            <td>Series:</td>
            <td><input type="text" disabled size=40 name='series' value='<?php echo $series ?>'></td>
        </tr>
        <tr>
            <td>Mô tả:</td>
            <td><textarea disabled cols=50 rows=5 name="moTa"><?php echo $moTa ?></textarea></td>
        </tr>
        <tr>
            <td>Nhà xuất bản:</td>
            <td><input type="text" disabled size=40 name='nxb' value='<?php echo $nxb ?>'></td>
        </tr>
        <tr>
            <td>Ngày phát hành:</td>
            <td><input type="date" disabled name='ngayPH' value='<?php echo $ngayPH ?>'></td>
        </tr>
        <tr>
            <td>Số trang:</td>
            <td><input type="text" disabled size=20 name='soTrang' value='<?php echo $soTrang ?>'></td>
        </tr>
        <tr>
            <td>Ngôn ngữ:</td>
            <td><input type="text" disabled size=20 name='ngonNgu' value='<?php echo $ngonNgu ?>'></td>
        </tr>
        <tr>
            <td>Đơn giá:</td>
            <td><input type="text" disabled size=20 name='donGia' value='<?php echo $donGia ?>'></td>
        </tr>
        <tr>
            <td>Số lượng tồn:</td>
            <td><input type="text" disabled size=20 name='soLuongTon' value='<?php echo $soLuongTon ?>'></td>
        </tr>
    </table>
    <p align=center><a id="goback" href="./hienthi_Truyen.php">Quay lại</a></p>
</main>

<script>
    var tab = document.getElementById('hienthi_Truyen');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>