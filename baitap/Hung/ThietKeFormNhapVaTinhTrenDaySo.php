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
    background: #b3cccc;
    border: 0 solid yellow;
    width: 400;
    }
    thead{
        background: #099969;    
    }
    h3{
        font-family: verdana;
        text-align: center;
        /* text-anchor: middle; */
        color: white;
        font-size: medium;
    }
</style>
<?php 
    if(isset($_POST['day_so']))  
        $day_so=trim($_POST['day_so']); 
    else $day_so='';
    if(isset($_POST['tong_day_so'])) 
        $tong_day_so=trim($_POST['tong_day_so']); 
    else $tong_day_so=0;

    if(isset($_POST['tinh'])) {
        $mang_so = explode(",", $day_so);
        $count = count($mang_so);
        $tong = 0;
        for ($i=0; $i<$count; $i++) {
            if (is_numeric($mang_so[$i])) {
                $tong += $mang_so[$i];
            }
            else {
                $tong = 0;
                echo "<font color='red'>Vui lòng nhập theo định dạng! </font>";
                break;
            }
        }
        $tong_day_so = $tong;
    }
    else {
        $tong_day_so = 0;
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h3></th>
        </thead>
        <tr>
            <td>Nhập dãy số: </td>
            <td><input type="text" size="30" name="day_so" value="<?php  echo $day_so;?> "/> <span style="color: red;">(*)</span></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Tổng dãy số" name="tinh" style="background: #cccc00;" /></td>
        </tr>
        <tr>
            <td>Tổng dãy số: </td>
            <td><input type="text" size="30"  name="tong_day_so" value="<?php  echo $tong_day_so;?>" disabled="disabled" style="color: red; background: #6fdc6f;"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><span style="color: red;">(*)</span> Các số được nhập cách nhau bằng dấu ","</td>
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