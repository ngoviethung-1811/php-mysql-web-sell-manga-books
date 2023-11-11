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
    if(isset($_POST['radPT']))  
        $phepTinh = $_POST['radPT'];
    else
        $phepTinh = "Cong";
    if(isset($_POST['so1'])) 
        $so1=trim($_POST['so1']); 
    else $so1='';
    if(isset($_POST['so2'])) 
        $so2=trim($_POST['so2']); 
    else $so2='';
?>
<form align="center" action="TaoTrangWebThucHienPhepTinhTren2So-ketquapheptinh.php" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>PHÉP TÍNH TRÊN 2 SỐ</h3></th>
        </thead>
        <tr>
            <td style="float: right;">Chọn phép tính:</td>
            <td>
                <input type="radio" name="radPT" value="Cong"<?php if(isset($_POST['radPT'])&&$_POST['radPT']=='Cong') echo 'checked="checked"';?> checked/> Cộng
                <input type="radio" name="radPT" value="Tru"<?php if(isset($_POST['radPT'])&&$_POST['radPT']=='Tru') echo 'checked="checked"';?>/> Trừ
                <input type="radio" name="radPT" value="Nhan"<?php if(isset($_POST['radPT'])&&$_POST['radPT']=='Nhan') echo 'checked="checked"';?>/> Nhân
                <input type="radio" name="radPT" value="Chia"<?php if(isset($_POST['radPT'])&&$_POST['radPT']=='Chia') echo 'checked="checked"';?>/> Chia
            </td>
        </tr>
        <tr>
            <td style="float: right;">Số thứ nhất:</td>
            <td><input type="text" name="so1" value="<?php  echo $so1;?> "/></td>
        </tr>
        <tr>
            <td style="float: right;">Số thứ nhì:</td>
            <td><input type="text" name="so2" value="<?php  echo $so2;?> "/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Tính" name="tinh" /></td>
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