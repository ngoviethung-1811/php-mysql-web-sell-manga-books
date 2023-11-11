<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
    <h1>Một số thao tác trên mảng số nguyên</h1>

    <form method="post">
        Nhập vào một số tự nhiên n: <input type="text" name="n">
        <input type="submit" value="Tạo mảng và thực hiện yêu cầu">
    </form>

    <?php
    function displayArray($arr) {
        echo "Mảng: " . implode(", ", $arr) . "<br>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = isset($_POST["n"]) ? (int)$_POST["n"] : 0; 
        if ($n <= 0) {
            echo "Vui lòng nhập số tự nhiên n hợp lệ.";
        } else {
            $randomArray = array();

            for ($i = 0; $i < $n; $i++) {
                $randomArray[] = rand(-1000, 1000);
            }

            displayArray($randomArray);

            $evenCount = count(array_filter($randomArray, function ($element) {
                return $element % 2 == 0;
            }));
            echo "Số lượng số chẵn trong mảng: $evenCount<br>";

            $lessThan100Count = count(array_filter($randomArray, function ($element) {
                return $element < 100;
            }));
            echo "Số lượng số nhỏ hơn 100 trong mảng: $lessThan100Count<br>";

            $negativeSum = array_reduce($randomArray, function ($carry, $element) {
                if ($element < 0) {
                    $carry += $element;
                }
                return $carry;
            }, 0);
            echo "Tổng của các số âm trong mảng: $negativeSum<br>";

            
            $numbersEndingWithZero = array_filter($randomArray, function ($element) {
                return $element % 10 == 0; 
            });
            
            echo "Số trong mảng có số cuối là số 0: " . implode(", ", $numbersEndingWithZero) . "<br>";
            

            sort($randomArray);
            displayArray($randomArray);
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
