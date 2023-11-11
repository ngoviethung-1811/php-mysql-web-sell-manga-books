<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
    <h2>Nhập các chữ số ngăn cách bằng dấu phẩy</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="numbers">Nhập các chữ số (ngăn cách bằng dấu phẩy):</label>
        <input type="text" id="numbers" name="numbers" required>
        <input type="submit" value="Tính Tổng">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ biểu mẫu và loại bỏ dấu phẩy
        $input = $_POST['numbers'];
        $numbers = explode(',', $input); // Chia chuỗi thành mảng
        $sum = 0;

        // Tính tổng các số
        foreach ($numbers as $number) {
            $sum += (int)$number; // Ép kiểu sang số nguyên
        }

        // Hiển thị kết quả
        echo "Tổng của các số đã nhập là: $sum";
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
