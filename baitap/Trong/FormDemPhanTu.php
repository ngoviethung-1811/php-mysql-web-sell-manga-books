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
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        form {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
    <h1>Trộn và sắp xếp mảng</h1>
    <form method="post" action="">
        <label for="arrayA">Mảng A:</label>
        <input type="text" name="arrayA" id="arrayA" required>
        <br>
        <label for="arrayB">Mảng B:</label>
        <input type="text" name "arrayB" id="arrayB" required>
        <br>
        <input type="submit" name="execute" value="Execute">
    </form>
    <?php
    if (isset($_POST['execute'])) {
        $arrayA = explode(',', $_POST['arrayA']);
        $arrayB = explode(',', $_POST['arrayB']);
        $mergedArray = array_merge($arrayA, $arrayB);
        sort($mergedArray);
        rsort($mergedArray);
        $countA = count($arrayA);
        $countB = count($arrayB);
    ?>
        <label for="countA">Số phần tử mảng A:</label>
        <input type="text" name="countA" id="countA" value="<?php echo $countA; ?>" readonly>
        <br>
        <label for="countB">Số phần tử mảng B:</label>
        <input type="text" name="countB" id="countB" value="<?php echo $countB; ?>" readonly>
        <br>
        <label for="mergedArray">Mảng C:</label>
        <input type="text" name="mergedArray" id="mergedArray" value="<?php echo implode(',', $mergedArray); ?>" readonly>
        <br>
        <label for="sortedArray">Mảng C tăng dần:</label>
        <input type="text" name="sortedArray" id="sortedArray" value="<?php echo implode(',', $mergedArray); ?>" readonly>
        <br>
        <label for="reverseSortedArray">Mảng C giảm dần:</label>
        <input type="text" name="reverseSortedArray" id="reverseSortedArray" value="<?php echo implode(',', array_reverse($mergedArray)); ?>" readonly>
    <?php
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

