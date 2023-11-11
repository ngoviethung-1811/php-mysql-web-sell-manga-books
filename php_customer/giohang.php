<?php
include('../includes/header.html');
?>

<link rel="stylesheet" href="../css/giohang.css">

<script type="text/javascript">
    function updateQuantity(index, change) {
        var quantityInput = document.getElementById('quantity_' + index);
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + change;

        if (newQuantity >= 1) {
            quantityInput.value = newQuantity;
        }
    }
</script>

<main>
<?php
if (isset($_POST['pay'])) {
    header('Location: thanhtoan.php');
    exit();
}

if (isset($_POST['removeItem'])) {
    $itemIndex = $_POST['removeItem'];
    if (isset($_SESSION['cart'][$itemIndex])) {
        unset($_SESSION['cart'][$itemIndex]);

        if (empty($_SESSION['cart'])) unset($_SESSION['cart']);
        header('Location: giohang.php');
    }
}

if (isset($_POST['updateCart'])) {
    foreach ($_POST['quantity'] as $index => $newQuantity) {
        $_SESSION['cart'][$index]['soLuong'] = $newQuantity;
    }
    header('Location: giohang.php');
    exit();
}

if (isset($_POST['clearCart'])) {
    unset($_SESSION['cart']);
    header('Location: giohang.php');
}

if (isset($_POST['addCart']) && isset($_POST['maTruyen']) && isset($_POST['anhBia']) && isset($_POST['tenTruyen']) && isset($_POST['soLuong']) && isset($_POST['donGia'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    $maTruyen = $_POST['maTruyen'];
    $anhBia = $_POST['anhBia'];
    $tenTruyen = $_POST['tenTruyen'];
    $soLuong = $_POST['soLuong'];
    $donGia = $_POST['donGia'];

    if (array_key_exists($maTruyen, $_SESSION['cart'])) {
        $_SESSION['cart'][$maTruyen]['soLuong'] += $soLuong;
    }
    else {
        $cartItem = array(
            'anhBia' => $anhBia,
            'tenTruyen' => $tenTruyen,
            'soLuong' => $soLuong,
            'donGia' => $donGia,
        );
    
        $_SESSION['cart'][$maTruyen] = $cartItem;
    }

    echo "<script>history.back()</script>";
    exit();
}


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo '<div align=center><h3>GIỎ HÀNG</h3></div>';
    echo "<form action='' method='POST'>";
    echo "<table>";
    echo "<tr><th>Ảnh Bìa</th><th>Tên Truyện</th><th>Số Lượng</th><th>Đơn Giá</th><th>Thành Tiền</th><th></th></tr>";

    $totalAmount = 0;

    foreach ($_SESSION['cart'] as $index => $cartItem) {
        echo "<tr>";
        echo "<td><img src='../images/" . $cartItem['anhBia'] . "' alt='" . $cartItem['tenTruyen'] . "' width='100'></td>";
        echo "<td>" . $cartItem['tenTruyen'] . "</td>";

        echo "<td>";
        echo '<button class="changeQuantity" type="button" onclick="updateQuantity(\''.$index.'\', -1)"><b>-</b></button>';
        echo "<input class='quantity' style='width: 30px;' type='number' min='1' name='quantity[$index]' id='quantity_$index' value='" . $cartItem['soLuong'] . "'>";


        echo '<button class="changeQuantity" type="button" onclick="updateQuantity(\''.$index.'\', 1)"><b>+</b></button>';
        echo "</td>";

        echo "<td id='donGia_$index'>" . number_format($cartItem['donGia'], 0, ",", ".") . "đ</td>";

        $thanhTien = $cartItem['donGia'] * $cartItem['soLuong'];
        $totalAmount += $thanhTien;
        echo "<td id='thanhTien_$index'>" . number_format($thanhTien, 0, ",", ".") . "đ</td>";

        echo "<td><button class='btnXoa' type='submit' name='removeItem' value='$index'>Xoá</button></td>";
        echo "</tr>";
    }
    echo "<tr><td colspan=6><b>Tổng Tiền:</b> <font color=red>" . number_format($totalAmount, 0, ",", ".") . "đ</font></td><tr>";

    echo "<tr><td id='thaotac' colspan=6>";
    echo "<a id='goback' href='index.php'>Tiếp tục mua hàng</a> ";
    echo "<button class='btnXoa' type='submit' name='clearCart' value='1'>XOÁ GIỎ HÀNG</button> ";
    echo "<button id='btnCapNhat' type='submit' name='updateCart' value='1'>CẬP NHẬT GIỎ HÀNG</button> ";
    echo "<button id='btnThanhToan' type='submit' name='pay' value='1'>THANH TOÁN</button>";
    echo "</td></tr>";

    echo "</table>";

    echo "</form>";

    } else {
        echo "<p align=center>Giỏ hàng của bạn trống.</p>";
    }

    if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > 60*60*24*7)) {
        unset($_SESSION['cart']);
    }
    $_SESSION['LAST_ACTIVITY'] = time();
?>
</main>

<?php
include('../includes/footer.php');
?>
