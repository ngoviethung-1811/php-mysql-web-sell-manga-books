<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
    <h2>Nhập số n để tạo mảng</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="n">Số n:</label>
        <input type="number" id="n" name="n" required>
        <input type="submit" name="create_array" value="Tạo Mảng">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_array'])) {
        $n = $_POST['n'];

        if (is_numeric($n) && $n > 0) {
            $array = array();
            for ($i = 0; $i < $n; $i++) {
                $array[] = rand(1, 100);
            }

            $maxValue = max($array);
            $minValue = min($array);
            $sum = array_sum($array);

            echo "Mảng được tạo:";
            echo "<input type='text' value='" . implode(", ", $array) . "' readonly size='1".(count($array)+1)."'><br>";
            echo "Giá trị lớn nhất: <input type='text' value='$maxValue' readonly><br>";
            echo "Giá trị nhỏ nhất: <input type='text' value='$minValue' readonly><br>";
            echo "Tổng mảng: <input type='text' value='$sum' readonly><br>";
        } else {
            echo "Vui lòng nhập một số nguyên dương.";
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
