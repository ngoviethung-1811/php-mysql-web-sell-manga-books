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
</style>
<?php
    if(isset($_POST['day_so']))  
        $day_so=trim($_POST['day_so']); 
    else $day_so='';
    if(isset($_POST['so']))  
        $so=trim($_POST['so']); 
    else $so='';
    if(isset($_POST['mang']))  
        $mang=trim($_POST['mang']); 
    else $mang='';
    if(isset($_POST['ketqua']))  
        $ketqua=trim($_POST['ketqua']); 
    else $ketqua='';

    function tim_kiem($arr, $gt) {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] == $gt)
                return $i;
        }
        return -1;
    }

    if(isset($_POST['tim'])) {
        if ($day_so != '' && $so != '') {
            $arr = explode(",", $day_so);
            $vitri = tim_kiem($arr, $so);
            $mang = implode(", ", $arr);
            if ($vitri >= 0)
                $ketqua = "Đã tìm thấy $so tại vị trí thứ " . $vitri+1 . " của mảng";
            else
                $ketqua = "Không tìm thấy $so trong mảng";
        }
        else {
            echo "<font color='red'>Vui lòng nhập đầy đủ thông tin! </font>";
            $mang = '';
            $ketqua = '';
        }
    }
    else {
        $mang = '';
        $ketqua = '';
    }
?>
<form align='center' action="" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>TÌM KIẾM</h3></th>
        </thead>
        <tr>
            <td>Nhập mảng: </td>
            <td><input type="text" size="50" name="day_so" value="<?php  echo $day_so;?> "/></td>
        </tr>
        <tr>
            <td>Nhập số cần tìm: </td>
            <td><input type="text" size="15" name="so" value="<?php  echo $so;?> "/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="   Tìm kiếm   " name="tim" style="background: #b2ede3;" /></td>
        </tr>
        <tr>
            <td>Mảng: </td>
            <td><input type="text" size="50"  name="mang" value="<?php  echo $mang;?>" disabled="disabled"/></td>
        </tr>
        <tr>
            <td>Kết quả tìm kiếm: </td>
            <td><input type="text" size="50"  name="ketqua" value="<?php  echo $ketqua;?>" disabled="disabled" style="color: red; background: #79f7e2;"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="background: #27f5d3;">(Các phần tử trong mảng sẽ cách nhau bằng dấu ",")</td>
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