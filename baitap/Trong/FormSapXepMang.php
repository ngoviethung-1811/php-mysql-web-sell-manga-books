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

        form {
            background-color: #fff;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="text"][readonly] {
            background-color: #f0f0f0;
        }
    </style>
    <form method="post">
        Nhập mảng: <input type="text" name="input_array">
        <input type="submit" name="sort_button" value="Sắp xếp">
    </form>

    <?php
    if (isset($_POST['sort_button'])) {
        $input_array = $_POST['input_array'];

        $array = explode(',', $input_array);

        $sorted_asc = $array;
        sort($sorted_asc);
        $sorted_desc = $array;
        rsort($sorted_desc);

        echo "Mảng tăng dần: <input type='text' value='" . implode(',', $sorted_asc) . "' readonly><br>";
        echo "Mảng giảm dần: <input type='text' value='" . implode(',', $sorted_desc) . "' readonly><br>";
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

