<?php
include('../includes/header.html');
?>

<link rel="stylesheet" href="../css/customer_index.css">

<main>
    <?php
        require("connect.php");

        $rowsPerPage = 5;
        if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
        }


        $offSet1 = ($_GET['page'] - 1) * $rowsPerPage;
        $offSet2 = 0;

        $result1 = mysqli_query($conn, 'SELECT * FROM truyen ORDER BY tenTruyen ASC LIMIT ' . $offSet1 . ',' . $rowsPerPage);

        $result2 = mysqli_query($conn, 'SELECT * FROM truyen ORDER BY ngayPhatHanh DESC LIMIT ' . $offSet2 . ',' . $rowsPerPage);

        echo "<p class='pageCaption' style='color: red;'>TRUYỆN MỚI NHẤT</p>";

        echo "<table>";
        if (mysqli_num_rows($result2) <> 0) {
            echo '<tr>';
            while ($row = mysqli_fetch_assoc($result2)) {
                echo '<td>';
                echo '<a class="linkTruyen" href="thongtintruyen.php?maTruyen=' . $row['maTruyen'] . '">';
                echo "<img class='anhbia' src='../images/" . $row['anhBia'] . "' alt='" . $row['tenTruyen'] . "'><br>";
                echo $row['tenTruyen'] . '</a><br>';
                echo number_format($row['donGia'], 0, ",", ".") . 'đ <br>';
                
                echo '<form action="giohang.php" method="POST">';
                echo '<input type="hidden" name="maTruyen" value="' . $row['maTruyen'] . '">';
                echo '<input type="hidden" name="anhBia" value="' . $row['anhBia'] . '">';
                echo '<input type="hidden" name="tenTruyen" value="' . $row['tenTruyen'] . '">';
                echo '<input type="hidden" name="donGia" value="' . $row['donGia'] . '">';
                echo '<input type="hidden" name="soLuong" value="1">';
                echo '<input class="btnAdd" type="submit" name="addCart" value="Thêm vào giỏ">';
                echo '</form>';
                
                echo '</td>';
            }
            echo '</tr>';
        }
        echo "</table>";

        echo "<br><p class='pageCaption'>TẤT CẢ TRUYỆN</p>";

        echo "<table>";
        if (mysqli_num_rows($result1) <> 0) {
            echo '<tr>';
            while ($row = mysqli_fetch_assoc($result1)) {
                echo '<td>';
                echo '<a class="linkTruyen" href="thongtintruyen.php?maTruyen=' . $row['maTruyen'] . '">';
                echo "<img class='anhbia' src='../images/" . $row['anhBia'] . "' alt='" . $row['tenTruyen'] . "'><br>";
                echo $row['tenTruyen'] . '</a><br>';
                echo number_format($row['donGia'], 0, ",", ".") . 'đ <br>';
                
                echo '<form action="giohang.php" method="POST">';
                echo '<input type="hidden" name="maTruyen" value="' . $row['maTruyen'] . '">';
                echo '<input type="hidden" name="anhBia" value="' . $row['anhBia'] . '">';
                echo '<input type="hidden" name="tenTruyen" value="' . $row['tenTruyen'] . '">';
                echo '<input type="hidden" name="donGia" value="' . $row['donGia'] . '">';
                echo '<input type="hidden" name="soLuong" value="1">';
                echo '<input class="btnAdd" type="submit" name="addCart" value="Thêm vào giỏ">';
                echo '</form>';
                
                echo '</td>';
            }
            echo '</tr>';
        }
        echo "</table>";

        $re1 = mysqli_query($conn, 'SELECT * FROM truyen');
        $numRows = mysqli_num_rows($re1);
        $maxPage = ceil($numRows / $rowsPerPage);

        echo "<div style='text-align: center; margin: 0.2rem;'>";
        echo "<div class='pagination'>";
        if ($_GET['page'] > 1) {
            echo "<a href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
            echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
        }
        else {
            echo "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
            echo "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
        }
        for ($i=1 ; $i<=$maxPage ; $i++){
            if ($i == $_GET['page'])
                echo "<a class='active'>".$i."</a>";
            else
                echo "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">".$i."</a>";
        }
        if ($_GET['page'] < $maxPage) {
            echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
            echo "<a href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
        }
        else {
            echo "<a class='disable' href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
            echo "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
        }
        echo '</div>';
        echo '</div>';
    ?>
</main>

<?php
include('../includes/footer.php');
?>