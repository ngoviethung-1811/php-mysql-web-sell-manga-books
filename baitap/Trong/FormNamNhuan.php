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
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #0073e6; 
        }
        label {
            color: #0073e6; 
            font-weight: bold;
        }
        input[type="number"] {
            border: 2px solid #0073e6;
            border-radius: 4px;
            padding: 5px;
        }
        input[type="submit"] {
            background-color: #0073e6; 
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0058a0; 
        }
        h3 {
            color: #0073e6; 
        }
    </style>
    <h2>Nhập một năm bất kỳ</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="year">Năm:</label>
        <input type="number" id="year" name="year" required>
        <input type="submit" value="Tìm Năm Nhuận">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input_year = $_POST['year'];

        if (is_numeric($input_year)) {
            $start_year = min(2000, $input_year);
            $end_year = max(2000, $input_year);

            echo "<h3>Các năm nhuận từ $start_year đến $end_year:</h3>";

            for ($year = $start_year; $year <= $end_year; $year++) {
                if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) {
                    echo $year . " ";
                }
            }
        } else {
            echo "Nhập năm hợp lệ.";
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
