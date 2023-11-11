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
            background-color: #f5f5f5;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <form method="post">
        <label for="array_input">Nhập mảng (ngăn cách bằng dấu phẩy):</label>
        <input type="text" id="array_input" name="array_input" required>

        <label for="element_to_replace">Phần tử cần thay thế:</label>
        <input type="text" id="element_to_replace" name="element_to_replace" required>

        <label for="replacement_element">Phần tử thay thế:</label>
        <input type="text" id="replacement_element" name="replacement_element" required>

        <input type="submit" name="submit" value="Thay thế">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $array_input = $_POST['array_input'];
        $element_to_replace = $_POST['element_to_replace'];
        $replacement_element = $_POST['replacement_element'];

        $array = explode(',', $array_input);

        $updated_array = array_map(function ($item) use ($element_to_replace, $replacement_element) {
            return ($item == $element_to_replace) ? $replacement_element : $item;
        }, $array);

        $result_array = implode(',', $updated_array);

        echo "<label for='result_array'>Mảng đã nhập:</label>";
        echo "<input type='text' id='result_array' value='$array_input' readonly>";

        echo "<label for='updated_array'>Mảng sau khi thay thế:</label>";
        echo "<input type='text' id='updated_array' value='$result_array' readonly>";
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
