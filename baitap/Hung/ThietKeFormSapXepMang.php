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
    width: 600;
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
    .output_field{
        background: #e0fdff;
    }
</style>
<?php
    if(isset($_POST['day_so']))  
        $day_so=trim($_POST['day_so']); 
    else $day_so='';
    if(isset($_POST['mangTang']))  
        $mangTang=trim($_POST['mangTang']); 
    else $mangTang='';
    if(isset($_POST['mangGiam']))  
        $mangGiam=trim($_POST['mangGiam']); 
    else $mangGiam='';

    function sapXepTang(&$arr) {
        $n = count($arr);
        for($i = 0; $i < $n - 1; $i++){
            for($j = $i + 1; $j < $n; $j++){
                if($arr[$i] > $arr[$j]){
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $tmp;        
                }
            }
        }
    }

    function sapXepGiam(&$arr) {
        $n = count($arr);
        for($i = 0; $i < $n - 1; $i++){
            for($j = $i + 1; $j < $n; $j++){
                if($arr[$i] < $arr[$j]){
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $tmp;        
                }
            }
        }
    }

    if(isset($_POST['sapxep'])) {
        $mang = explode(",", $day_so);

        // Kiem tra mang so
        $allNum = true;
        foreach ($mang as $so) {
            if (!is_numeric($so)) {
                $allNum = false;
                break;
            }
        }

        if ($allNum) {
            sapXepTang($mang);
            $mangTang = implode(", ", $mang);
            sapXepGiam($mang);
            $mangGiam = implode(", ", $mang);
        }
        else {
            echo "<font color='red'>Vui lòng nhập vào số! </font>";
            $mangTang = '';
            $mangGiam = '';
        }
    }
    else {
        $mangTang = '';
        $mangGiam = '';
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>SẮP XẾP MÁNG</h3></th>
        </thead>
        <tr>
            <td>Nhập mảng: </td>
            <td><input type="text" size="50" name="day_so" value="<?php  echo $day_so;?> "/><span style="color: red;"> (*)</span></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="   Sắp xếp tăng/giảm   " name="sapxep" style="background: white;" /></td>
        </tr>
        <tr>
            <td class="output_field"><b style="color: red;">Sau khi sắp xếp:</b></td>
            <td class="output_field"></td>
        </tr>
        <tr>
            <td class="output_field">Tăng dần: </td>
            <td class="output_field"><input type="text" size="50"  name="mang" value="<?php  echo $mangTang;?>" disabled="disabled" style="background: #79f7e2;"/></td>
        </tr>
        <tr>
            <td class="output_field">Giảm dần: </td>
            <td class="output_field"><input type="text" size="50"  name="mang" value="<?php  echo $mangGiam;?>" disabled="disabled" style="background: #79f7e2;"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><span style="color: red;">(*) </span>Các số được nhập cách nhau bằng dấu ","</td>
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