<?php
include('../includes/header.html');
?>

<link rel="stylesheet" href="../css/timkiem.css">

<main>
<?php
    require("connect.php");

    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        $sql = "SELECT truyen.*, tacgia.tenTG, series.tenSeries, theloai.tenTL, nhaxuatban.tenNXB 
                FROM truyen
                LEFT JOIN tacgia ON truyen.maTG = tacgia.maTG
                LEFT JOIN series ON truyen.maSeries = series.maSeries
                LEFT JOIN theloai ON truyen.maTL = theloai.maTL
                LEFT JOIN nhaxuatban ON truyen.maNXB = nhaxuatban.maNXB
                WHERE truyen.tenTruyen LIKE '%$search%'
                ORDER BY truyen.tenTruyen";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr class="trTruyen">';
                echo '<td>';
                echo '<img class="anhbia" src="../images/' . $row['anhBia'] . '">';
                echo '</td>';
                echo '<td>';
                echo '<h3><a class="linkTim" href="thongtintruyen.php?maTruyen=' . $row['maTruyen'] . '">' . $row['tenTruyen'] . '</a></h3><br>';
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
                echo "<br><p>".$row['moTa']."</p><br>";
                echo "<p>";
                echo "<p id='txtDonGia'>".number_format($row['donGia'], 0, ",", ".")."đ</p>";

                echo '<form action="giohang.php" method="POST">';
                echo '<input type="hidden" name="maTruyen" value="' . $row['maTruyen'] . '">';
                echo '<input type="hidden" name="anhBia" value="' . $row['anhBia'] . '">';
                echo '<input type="hidden" name="tenTruyen" value="' . $row['tenTruyen'] . '">';
                echo '<input type="hidden" name="donGia" value="' . $row['donGia'] . '">';
                echo '<input type="hidden" name="soLuong" value="1">';
                echo '<input class="btnAdd" type="submit" name="addCart" value="Thêm vào giỏ">';
                echo '</form>';

                echo '</p>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "<p align=center><font color=red>Không tìm thấy kết quả.</font></p>";
        }
    }
?>
</main>

<?php
include('../includes/footer.php');
?>
