<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<?php
if (isset($_GET['ma_sua'])) {
    $displayContent = "";
    $displayNotFound = "display: none";
    $maSua = $_GET['ma_sua'];

    require("QLBanSua_connect.php");
    $result = mysqli_query($conn, "SELECT Ma_sua, Hinh, Ten_sua, Ten_hang_sua, Ten_loai, Trong_luong, Don_gia, TP_Dinh_Duong, Loi_ich FROM 
	sua, loai_sua, hang_sua WHERE sua.Ma_loai_sua=loai_sua.Ma_loai_sua AND sua.Ma_hang_sua=hang_sua.Ma_hang_sua
    AND sua.Ma_sua='$maSua'");

    if(mysqli_num_rows($result)<>0) {
        while($rows=mysqli_fetch_assoc($result)) {
            $hinh = $rows['Hinh'];
            $tenSua = $rows['Ten_sua'];
            $tenHangSua = $rows['Ten_hang_sua'];
            $tenLoaiSua = $rows['Ten_loai'];
            $trongLuong = $rows['Trong_luong'];
            $donGia = $rows['Don_gia'];
            $thanhPhan = $rows['TP_Dinh_Duong'];
            $loiIch = $rows['Loi_ich'];
        }
    }
}
else {
    $displayNotFound = "";
    $displayContent = "display: none";
}
?>
<style>
    #qlbsContent {
        display: flex;
        justify-content: center;
    }
    #ttSua {            
        <?php echo $displayContent; ?>
        width: 50rem;
    }
    #notFound {            
        <?php echo $displayNotFound; ?>
    }
    table {
        border: 3px solid orange;
    }
    #tableHeader {
        background: #f2e0d8;
        color: #ed5009;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 700;
        height: 2rem;
    }
    td {
        border: 1px solid black;
    }
</style>
<div id="qlbsContent">
    <div id="ttSua">
        <table>
            <tr>
                <td id='tableHeader' colspan=2><?php echo $tenSua; ?> - <?php echo $tenHangSua; ?></td>
            </tr>
            <tr>
                <td><img style='width:15rem; height:15rem;' src="./images/Hinh_sua/<?php echo $hinh; ?>" alt="Hinh_sua"></td>
                <td>
                    <b>Thành phần dinh dưỡng:</b><br>
                    <?php echo $thanhPhan; ?><br>
                    <b>Lợi ích:</b><br>
                    <?php echo $loiIch; ?><br>
                    <span style='float: right;'>
                        <b>Trọng lượng: </b> <?php echo $trongLuong; ?> gr - 
                        <b>Đơn giá: </b> <?php echo $donGia; ?> VNĐ
                    </span>
                </td>
            </tr>
            <tr>
                <td><a href='javascript:window.history.back(-1);' style='float: right;'>Quay về</a></td>
            </tr>
        </table>
    </div>
    <div id="notFound">
        <h1 class="error-message" style="color: red;">404 Not Found</h1>
        <p>Trang bạn đang tìm không tồn tại.</p>
    </div>
</div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>