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
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            background-color: #fff;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <div class="container">
        <h2>Tìm kiếm giá trị trong mảng</h2>
        <form method="post" action="">
            <label for="inputArray">Nhập mảng (cách nhau bằng dấu phẩy):</label>
            <input type="text" name="inputArray" id="inputArray" required>

            <label for="searchValue">Nhập giá trị cần tìm:</label>
            <input type="text" name="searchValue" id="searchValue" required>

            <input type="submit" name="submit" value="Tìm kiếm">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $inputArray = $_POST['inputArray'];
            $searchValue = $_POST['searchValue'];
            $array = explode(',', $inputArray);
            $position = array_search($searchValue, $array);
            echo "<p>Mảng đã nhập: " . $inputArray . "</p>";
            if ($position !== false) {
                echo "<p>Vị trí của giá trị '$searchValue' trong mảng: " . ($position + 1) . "</p>";
            } else {
                echo "<p>Không tìm thấy giá trị '$searchValue' trong mảng. Vị trí: -1</p>";
            }
        }
        ?>
    </div>

    </main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>