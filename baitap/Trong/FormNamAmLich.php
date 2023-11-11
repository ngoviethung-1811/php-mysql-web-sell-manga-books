<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
    <h2>Nhập một năm dương lịch bất kỳ</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="year">Năm Dương Lịch:</label>
        <input type="text" id="year" name="year" required>
        <input type="submit" value="Tìm Năm Âm Lịch">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input_year = $_POST['year'];

        if (is_numeric($input_year)) {
            $input_year = (int)$input_year;

            $can = array("Quý", "Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm");
            $chi = array("Tý", "Sửu", "Dần", "Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất", "Hợi");

            $canIndex = ($input_year - 3) % 10;
            $chiIndex = ($input_year - 1900) % 12;

            $year_name = "{$can[$canIndex]} {$chi[$chiIndex]}";
            $image = "images/{$chi[$chiIndex]}.jpg";

            echo "<h3>Năm âm lịch tương ứng với $input_year:</h3>";
            echo "Năm âm lịch: <input type='text' value='$year_name' readonly><br>";
            echo "<img src='$image' alt='Hình ảnh năm âm lịch $year_name'><br>";
        } else {
            echo "Vui lòng nhập một năm hợp lệ.";
        }
    }
    ?>

</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>
