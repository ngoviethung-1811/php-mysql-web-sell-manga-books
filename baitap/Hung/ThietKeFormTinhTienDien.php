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
    table{
    background: #ffd94d;
    border: 0 solid yellow;
    }
    thead{
        background: #fff14d;    
    }
    td {
        color: blue;
    }
    h3{
        font-family: verdana;
        text-align: center;
        /* text-anchor: middle; */
        color: #ff8100;
        font-size: medium;
    }
</style>
<?php 
    if(isset($_POST['tenCH']))  
        $tenCH=trim($_POST['tenCH']); 
    else $tenCH="";
    if(isset($_POST['chiSoCu']))  
        $chiSoCu=trim($_POST['chiSoCu']); 
    else $chiSoCu=0;
    if(isset($_POST['chiSoMoi']))  
        $chiSoMoi=trim($_POST['chiSoMoi']); 
    else $chiSoMoi=0;
    if(isset($_POST['donGia']))  
        $donGia=trim($_POST['donGia']); 
    else $donGia=2000;
    if(isset($_POST['tienThanhToan']))  
        $tienThanhToan=trim($_POST['tienThanhToan']); 
    else $tienThanhToan=0;
    if(isset($_POST['tinh'])) {
        if ($tenCH!="" && isset($_POST['chiSoCu']) && isset($_POST['chiSoMoi'])&& isset($_POST['donGia'])) {
            if (is_numeric($chiSoCu) && is_numeric($chiSoMoi) && is_numeric($donGia)) {
                if ($chiSoCu <= $chiSoMoi)
                    $tienThanhToan = ($chiSoMoi - $chiSoCu) * $donGia;
                else
                    echo "<font color='red'>Vui lòng nhập chỉ số cũ nhỏ hơn chỉ số mới! </font>";
            }
            else {
                echo "<font color='red'>Vui lòng nhập vào số! </font>";
            }

        }
        else {
            echo "<font color='red'>Vui lòng nhập đầy đủ thông tin! </font>"; 
        }
    }
?>
<form align='center' action="tinhTienDien.php" method="post">
    <table>
        <thead>
            <th colspan="3" align="center"><h3>THANH TOÁN TIỀN ĐIỆN</h3></th>
        </thead>
        <tr>
            <td>Tên chủ hộ:</td>
            <td><input type="text" name="tenCH" value="<?php  echo $tenCH;?>"/></td>
        </tr>
        <tr>
            <td>Chỉ số cũ:</td>
            <td><input type="text" name="chiSoCu" value="<?php  echo $chiSoCu;?>"/></td>
            <td>(Kw)</td>
        </tr>
        <tr>
            <td>Chỉ số mới:</td>
            <td><input type="text" name="chiSoMoi" value="<?php  echo $chiSoMoi;?>"/></td>
            <td>(Kw)</td>
        </tr>
        <tr>
            <td>Đơn giá:</td>
            <td><input type="text" name="donGia" value="<?php  echo $donGia;?>"/></td>
            <td>(VNĐ)</td>
        </tr>
        <tr>
            <td>Số tiền thanh toán:</td>
            <td><input type="text" name="tienThanhToan" value="<?php  echo $tienThanhToan;?>" disabled="disabled"/></td>
            <td>(VNĐ)</td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="submit" value="Tính" name="tinh" /></td>
        </tr>
    </table>
</form>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>