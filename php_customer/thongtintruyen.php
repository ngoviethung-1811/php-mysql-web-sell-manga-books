<?php
include('../includes/header.html');
?>

<link rel="stylesheet" href="../css/thongtintruyen.css">

<script>
    function updateQuantity(change) {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + change;

        if (newQuantity >= 1) {
            quantityInput.value = newQuantity;
        }
    }
</script>

<main>
<?php
    require("connect.php");

    if (isset($_GET['maTruyen'])) {
        $maTruyen = $_GET['maTruyen'];
        
        $query = "SELECT t.maTruyen, t.tenTruyen, t.anhBia, s.maSeries, s.tenSeries, tl.maTL, tl.tenTL, nxb.maNXB, nxb.tenNXB, tg.maTG, tg.tenTG, t.soTrang, t.ngonNgu, t.ngayPhatHanh, t.donGia, t.soLuongTon, t.moTa
                FROM truyen t
                INNER JOIN series s ON t.maSeries = s.maSeries
                INNER JOIN theloai tl ON t.maTL = tl.maTL
                INNER JOIN nhaxuatban nxb ON t.maNXB = nxb.maNXB
                INNER JOIN tacgia tg ON t.maTG = tg.maTG
                WHERE t.maTruyen = '$maTruyen'";
        
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $tenTruyen = $row['tenTruyen'];
            $anhBia = $row['anhBia'];
            $moTa = $row['moTa'];
            $tenSeries = $row['tenSeries'];
            $tenTL = $row['tenTL'];
            $tenNXB = $row['tenNXB'];
            $tenTG = $row['tenTG'];
            $soTrang = $row['soTrang'];
            $ngonNgu = $row['ngonNgu'];
            $ngayPhatHanh = $row['ngayPhatHanh'];
            $donGia = $row['donGia'];
            $soLuongTon = $row['soLuongTon'];
            $maTG = $row['maTG'];
            $maSeries = $row['maSeries'];
            $maTL = $row['maTL'];
            $maNXB = $row['maNXB'];

            echo "<div class='container'>";
            echo "<div class='cover'>";
            echo "<img id='cover-image' src='../images/$anhBia' alt='$tenTruyen'>";
            echo "</div>";
            echo "<div class='info'>";
            echo "<p><h2>$tenTruyen</h2></p><br>";
            echo "<table>
                    <tr>
                        <td><strong>Series: </strong><a class='linkTim' href='timkiem_series.php?maSeries=" . $row['maSeries'] . "'>" . $row['tenSeries'] . "</a></td>
                        <td><strong>Tác giả: </strong><a class='linkTim' href='timkiem_tacgia.php?maTG=" . $row['maTG'] . "'>" . $row['tenTG'] . "</a></td>
                    </tr>
                    <tr>
                        <td><strong>Thể loại: </strong><a class='linkTim' href='timkiem_theloai.php?maTL=" . $row['maTL'] . "'>" . $row['tenTL'] . "</a></td>
                        <td><strong>Nhà xuất bản: </strong><a class='linkTim' href='timkiem_nxb.php?maNXB=" . $row['maNXB'] . "'>" . $row['tenNXB'] . "</a></td>
                    </tr>
                </table>";
            if ($moTa !== '')
                echo "<p><strong>Tóm tắt nội dung: </strong></p><p>$moTa</p><br>";
            echo "</div>";
            echo "<div class='addCartItems'>";
            echo "<div class='rectangle-box'>";
            echo "<p><strong>Số trang:</strong> $soTrang</p><br>";
            echo "<p><strong>Ngôn ngữ:</strong> $ngonNgu</p><br>";
            echo "<p><strong>Ngày phát hành: </strong>".date("d/m/Y", strtotime($ngayPhatHanh))."</p><br>";
            echo "</div>";
            echo '<form action="giohang.php" method="POST">';
            echo '<input type="hidden" name="maTruyen" value="' . $row['maTruyen'] . '">';
            echo '<input type="hidden" name="anhBia" value="' . $row['anhBia'] . '">';
            echo '<input type="hidden" name="tenTruyen" value="' . $row['tenTruyen'] . '">';
            echo '<input type="hidden" name="donGia" value="' . $row['donGia'] . '">';
            echo "<p id='txtDonGia'>".number_format($row['donGia'], 0, ",", ".")."đ<p>";
            echo '<p class="cartInfo"><strong>Số lượng</strong></p>';
            echo '<p class="cartInfo">';
            echo "<button class='changeQuantity' type='button' onclick='updateQuantity(-1)'><b>-</b></button>";
            echo '<input id="quantity" type="number" name="soLuong" value="1" min="1">';
            echo "<button class='changeQuantity' type='button' onclick='updateQuantity(1)'><b>+</b></button>";
            echo '</p>';
            echo '<p class="cartInfo"><input id="btnAdd" type="submit" name="addCart" value="Thêm vào giỏ"></p></form>'; 
            echo '</form>';
            echo "</div>";
            echo "</div>";

        }
    } else {
        header("Location: ../html/not_found.html");
        exit();
    }
?>
</main>

<?php
include('../includes/footer.php');
?>