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
	if(isset($_POST['tinh']))
	    if (is_numeric($so1) && is_numeric($so2)) {
	        switch ($phepTinh) {
			    case "Cong":
			        $ketQua = $so1 + $so2;
			        break;
			    case "Tru":
			        $ketQua = $so1 - $so2;
			        break;
			    case "Nhan":
			        $ketQua = $so1 * $so2;
			        break;
			    case "Chia":
			        $ketQua = $so1 / $so2;
			        break;
			}

			echo '<link rel="stylesheet" href="Bai3_TaoTrangWebThucHienPhepTinhTren2So.css">
			<table>
		                <thead>
		                    <th colspan="2" align="center"><h3>PHÉP TÍNH TRÊN 2 SỐ</h3></th>
		                </thead>
		                <tr>
		                    <td style="float: right;">Chọn phép tính:</td>';
		    switch ($phepTinh) {
			    case "Cong":
			        echo '<td>Cộng</td>';
			        break;
			    case "Tru":
			        echo '<td>Trừ</td>';
			        break;
			    case "Nhan":
			        echo '<td>Nhân</td>';
			        break;
			    case "Chia":
			        echo '<td>Chia</td>';
			        break;
			}
			echo "<tr>
                    <td style='float: right;'>Số 1:</td>
                    <td><input type='text' name='so1' value='$so1' disabled='disabled'/></td>
               </tr>
               <tr>
                    <td style='float: right;'>Số 2:</td>
                    <td><input type='text' name='so2' value='$so2' disabled='disabled'/></td>
               </tr>
               <tr>
                    <td style='float: right;'>Kết quả:</td>
                    <td><input type='text' name='ketQua' value='$ketQua' disabled='disabled'/></td>
               </tr>";
            echo "<tr>
                    <td></td>
                    <td><a href='javascript:window.history.back(-1);'>Quay lại trang trước</a></td>
               </tr>
           </table>
       </form>";
	    }
	    else {
	    	$url = $_SERVER['HTTP_REFERER'];
	        header("Location: $url");
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