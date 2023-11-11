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
    if(isset($_POST['chieudai']))  
        $chieudai=trim($_POST['chieudai']); 
    else $chieudai=0;
    if(isset($_POST['chieurong'])) 
        $chieurong=trim($_POST['chieurong']); 
    else $chieurong=0;
    if(isset($_POST['tinh']))
        if (is_numeric($chieudai) && is_numeric($chieurong)) {
            $chuvi=($chieudai+$chieurong)*2;
            $dientich=$chieudai * $chieurong;
        }
        else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            $chuvi="";
            $dientich="";
        }
    else {
        $chuvi=0;
        $dientich=0;
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>DIỆN TÍCH HÌNH CHỮ NHẬT</h3></th>
        </thead>
        <tr><td>Chiều dài:</td>
            <td><input type="text" name="chieudai" value="<?php  echo $chieudai;?> "/></td>
        </tr>
        <tr><td>Chiều rộng:</td>
            <td><input type="text" name="chieurong" value="<?php  echo $chieurong;?> "/></td>
        </tr>
        <tr><td>Chu vi:</td>
            <td><input type="text" name="chuvi" disabled="disabled" value="<?php  echo $chuvi;?> "/></td>
        </tr>
        <tr><td>Diện tích:</td>
            <td><input type="text" name="dientich" disabled="disabled" value="<?php  echo $dientich;?> "/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>
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