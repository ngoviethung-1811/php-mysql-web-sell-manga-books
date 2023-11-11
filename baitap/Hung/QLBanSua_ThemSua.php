<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
<?php

require("QLBanSua_connect.php");

$resHangSua = mysqli_query($conn, "SELECT Ma_hang_sua, Ten_hang_sua FROM hang_sua");
if(mysqli_num_rows($resHangSua)<>0) {
    $inputHangSua = "<select name='hangSua'>";
    while($rows=mysqli_fetch_assoc($resHangSua)){
        $selected = '';
        if(isset($_POST['hangSua']) && $_POST['hangSua']==$rows['Ma_hang_sua']) $selected = 'selected';
        $inputHangSua .= "<option value=${rows['Ma_hang_sua']} ".$selected.">
                ${rows['Ten_hang_sua']}
                </option>";
	}
    $inputHangSua .= "</select>";
}

$resLoaiSua = mysqli_query($conn, "SELECT Ma_loai_sua, Ten_loai FROM loai_sua");
if(mysqli_num_rows($resLoaiSua)<>0) {
    $inputLoaiSua = "<select name='loaiSua'>";
    while($rows=mysqli_fetch_assoc($resLoaiSua)){
        $selected = '';
        if(isset($_POST['loaiSua']) && $_POST['loaiSua']==$rows['Ma_loai_sua']) $selected = 'selected';
        $inputLoaiSua .= "<option value=${rows['Ma_loai_sua']} ".$selected.">
                ${rows['Ten_loai']}
            </option>";
	}
    $inputLoaiSua .= "</select>";
}

function themSua($maSua, $tenSua, $maHangSua, $maLoaiSua, $trongLuong, $donGia, $tpDD, $loiIch, $hinhAnh) {
    global $conn;
    $result = mysqli_query($conn, "INSERT INTO sua (Ma_sua, Ten_sua, Ma_hang_sua, Ma_loai_sua, Trong_luong, Don_gia,
        TP_Dinh_Duong, Loi_ich, Hinh)
        VALUES ('$maSua', '$tenSua', '$maHangSua', '$maLoaiSua', 
        '$trongLuong', '$donGia', '$tpDD', '$loiIch', '$hinhAnh');");
    return $result;
}

if (isset($_POST['maSua']))
    $maSua = trim($_POST['maSua']);
else $maSua = '';
if (isset($_POST['tenSua']))
    $tenSua = trim($_POST['tenSua']);
else $tenSua = '';
if (isset($_POST['hangSua']))
    $hangSua = trim($_POST['hangSua']);
else $hangSua = '';
if (isset($_POST['loaiSua']))
    $loaiSua = trim($_POST['loaiSua']);
else $loaiSua = '';
if (isset($_POST['trongLuong']))
    $trongLuong = trim($_POST['trongLuong']);
else $trongLuong = '';
if (isset($_POST['donGia']))
    $donGia = trim($_POST['donGia']);
else $donGia = '';
if (isset($_POST['tpDD']))
    $tpDD = trim($_POST['tpDD']);
else $tpDD = '';
if (isset($_POST['loiIch']))
    $loiIch = trim($_POST['loiIch']);
else $loiIch = '';

$thongBao = '';
$ketquaThemTC = '';

if (isset($_POST['them'])) {
    if ($maSua=='' || $tenSua == '' || $hangSua == '' || $loaiSua == '' || $trongLuong == '' || 
        $donGia == '' || $tpDD == '' || $loiIch == '' || isset($_FILES['hinhAnh'])==NULL) {
        $thongBao = "<font color=red>Kiểm tra lại thông tin nhập vào!</font>";
        $ketquaThemTC = '';
    }
    else {
        $errors= array();

        $resMaSua = mysqli_query($conn, "SELECT Ma_sua FROM sua WHERE Ma_sua='$maSua'");
        if (mysqli_num_rows($resMaSua)<>0) {
            $errors[]='Mã sữa đã tồn tại!';
        }

        $file_name = $_FILES['hinhAnh']['name'];
        $file_size =$_FILES['hinhAnh']['size'];
        $file_tmp =$_FILES['hinhAnh']['tmp_name'];
        $file_type=$_FILES['hinhAnh']['type'];
        $file_ext=@strtolower(end(explode('.',$_FILES['hinhAnh']['name'])));
        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions) === false){
            $errors[]="Hình ảnh chỉ nhận file JPEG hoặc PNG.";
        }
        if($file_size > 2097152){
            $errors[]='File hình nên nhỏ hơn 2MB.';
        }
        if(empty($errors)) {
            move_uploaded_file($file_tmp,"./images/Hinh_sua/".$file_name);

            $kqThem = themSua($maSua, $tenSua, $hangSua, $loaiSua, 
                $trongLuong, $donGia, $tpDD, $loiIch, $file_name);
            
            if ($kqThem) {
                $thongBao = "<font color=green>Thêm sữa thành công!</font><br>";

                $resTenHangSua= mysqli_query($conn, "SELECT Ten_hang_sua FROM hang_sua 
                    WHERE Ma_hang_sua='" . $hangSua . "'");
                $tenHangSua = '';
                if (mysqli_num_rows($resTenHangSua)<>0) {
                    while($rows=mysqli_fetch_assoc($resTenHangSua)){
                        $tenHangSua = $rows['Ten_hang_sua'];
                    }
                }

                $ketquaThemTC = "
                    <table id='bangketqua'>
                        <tr>
                            <td colspan=2 id='tableHeader'>$tenSua - $tenHangSua</td>
                        </tr>
                        <tr>
                            <td><img style='width:10rem; height:10rem;' src='./images/Hinh_sua/$file_name'/></td>
                            <td>
                                <b>Thành phần dinh dưỡng: </b><br>
                                $tpDD<br>
                                <b>Lợi ích:</b><br>
                                <pre>$loiIch</pre><br>
                                <b>Trọng lượng: </b><font color=red>$trongLuong gr</font> - 
                                <b>Đơn giá: </b><font color=red>$donGia VNĐ</font>
                            </td>
                        </tr>
                    </table>
                ";
            }
            else {
                $thongBao = "<font color=red>Thêm sữa không thành công!</font><br>";
                $ketquaThemTC = '';
            }
        }
        else {
            $ketquaThemTC = '';
            $thongBao = "";
            foreach ($errors as $value) {
                $thongBao .= "<font color=red>$value</font><br>";
            }
        }
    }
}

?>

<style>
    #qlbsContent {
        display: flex;
        justify-content: center;
    }
    table {
        background: #fae3de;
    }
    thead {
        text-align: center;
        color: WHITE;
        font-weight: 900;
        background: #f58167;
        font-size: 1.3rem;
    }
    td {
        padding: 0.5rem;  
    }
    #bangketqua {
        margin-top: 1rem;
        background: white;
        border: 2px solid orange;
    }
    #bangketqua #tableHeader {
        background: #f2e0d8;
        color: #ed5009;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 700;
    }
</style>
<div id="qlbsContent">  
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <thead>
                <td colspan=2><h3>THÊM SỮA MỚI</h3></td>
            </thead>
            <tr>
                <td>Mã sữa:</td>
                <td><input type="text" name="maSua" size=20 value="<?php echo $maSua; ?>"></td>
            </tr>
            <tr>
                <td>Tên sữa:</td>
                <td><input type="text" name="tenSua" size=40 value="<?php echo $tenSua; ?>"></td>
            </tr>
            <tr>
                <td>Hãng sữa:</td>
                <td><?php echo $inputHangSua; ?></td>
            </tr>
            <tr>
                <td>Loại sữa:</td>
                <td><?php echo $inputLoaiSua; ?></td>
            </tr>
            <tr>
                <td>Trọng lượng:</td>
                <td><input type="text" name="trongLuong" size=20 value="<?php echo $trongLuong; ?>"> (gr hoặc ml)</td>
            </tr>
            <tr>
                <td>Đơn giá:</td>
                <td><input type="text" name="donGia" size=20 value="<?php echo $donGia; ?>"> (VNĐ)</td>
            </tr>
            <tr>
                <td>Thành phần dinh dưỡng:</td>
                <td>
                    <textarea name="tpDD" rows="2" cols="50"><?php echo $tpDD; ?></textarea>
				</td>
            </tr>
            <tr>
                <td>Lợi ích:</td>
                <td>
                    <textarea name="loiIch" rows="2" cols="50"><?php echo $loiIch; ?></textarea>
				</td>
            </tr>
            <tr>
                <td>Hình ảnh:</td>
                <td><input type="file" name ="hinhAnh"></td>
            </tr>
            <tr>
                <td colspan=2 align=center><input type="submit" name ="them" value="Thêm mới"></td>
            </tr>
            <tr>
                <td colspan=2 align=center><?php echo $thongBao; ?></td>
            </tr>
        </table>

        <?php echo $ketquaThemTC; ?>
    </form>
</div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>