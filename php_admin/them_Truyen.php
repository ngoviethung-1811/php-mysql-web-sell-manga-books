<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<style>
    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
        color: #fff;
        position: relative;
    }
    input[type="date"]::-webkit-datetime-edit-year-field{
        position: absolute !important;
        border-left:1px solid black;
        color:#000;
        left: 56px;
    }
    input[type="date"]::-webkit-datetime-edit-month-field{
        position: absolute !important;
        border-left:1px solid black;
        color:#000;
        left: 26px;
    }
    input[type="date"]::-webkit-datetime-edit-day-field{
        position: absolute !important;
        color:#000;
        left: 4px;
    }
</style>

<?php
    require("connect.php");

    function taoMaTruyen() {
        GLOBAL $conn;

        $sql = "SELECT MAX(maTruyen) AS maTruyen_max FROM truyen";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maTruyen_max"];

        $idTruyen = intval(substr($idMax, 2)) + 1;

        $TT = str_pad($idTruyen, 5, "0", STR_PAD_LEFT);

        return "tt" . $TT;
    }

    $matruyen = taoMaTruyen();
    $thongbao = '';
    $thongbaoFILE = '';

    if(isset($_POST['tentruyen']))  
        $tentruyen=trim($_POST['tentruyen']); 
    else $tentruyen = '';

    if(isset($_POST['theloai']))  
        $theloai=trim($_POST['theloai']);
    else $theloai = '';

    if(isset($_POST['ngayphathanh']))  
        $ngayphathanh=trim($_POST['ngayphathanh']); 
    else $ngayphathanh = date('Y-m-d');

    if(isset($_POST['series']))  
        $series=trim($_POST['series']); 
    else $series = '';

    if(isset($_POST['tacgia']))  
        $tacgia=trim($_POST['tacgia']); 
    else $tacgia = '';

    if(isset($_POST['nxb']))  
        $nxb=trim($_POST['nxb']); 
    else $nxb = '';

    if(isset($_POST['dongia']))  
        $dongia=trim($_POST['dongia']); 
    else $dongia = '';

    if(isset($_POST['soluongton']))  
        $soluongton=trim($_POST['soluongton']); 
    else $soluongton = '';

    if(isset($_POST['sotrang']))  
        $sotrang=trim($_POST['sotrang']); 
    else $sotrang = '';

    if(isset($_POST['ngonngu']))  
        $ngonngu=trim($_POST['ngonngu']); 
    else $ngonngu = '';

    if(isset($_POST['mota']))  
        $mota=trim($_POST['mota']); 
    else $mota = '';


    if(isset($_FILES['image'])!=NULL){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=@strtolower(end(explode('.',$_FILES['image']['name'])));
        $expensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Chỉ nhận file ảnh JPEG, JPG, PNG";
        }
        if($file_size > 4297152){
            $errors[]='File ảnh không vượt quá 4MB';
        }
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,'../images/'.$file_name);
        }
        else{
            $thongbaoFILE = '';
            foreach ($errors as $error) {
                $thongbaoFILE .= "<p align=center><font color=red>$error</font></p>";
            }
            $file_name="";
        }
    }
    else $file_name="";

    if(isset($_POST['them']))
    {
        if($tentruyen=='' || $theloai=='' || $series=='' || $tacgia=='' || $nxb=='' || $dongia=='' || 
            $soluongton=='' || $sotrang=='' || $ngonngu=='' || $mota=='' || $file_name=='' || $ngayphathanh=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else if ($soluongton <= 0 || $sotrang <= 0) {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập số dương!</font></p>";
        }
        else
        {
            $sql = "INSERT INTO truyen (maTruyen, tenTruyen, anhBia, maSeries, maTL, maNXB, maTG, moTa, soTrang, ngonNgu, ngayPhatHanh, donGia, soLuongTon) 
                VALUES ('$matruyen', '$tentruyen', '$file_name', '$series', '$theloai', '$nxb', '$tacgia', '$mota', '$sotrang', '$ngonngu', '$ngayphathanh', '$dongia', '$soluongton')";
            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
                $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                $matruyen = taoMaTruyen();
            }
            else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
        }
        
    }
?>

<main>
    <p id='pageCaption'>THÊM TRUYỆN</p>
    <form  action="" method="post" enctype="multipart/form-data">
    <table>
        <tr><td colspan=2><?php echo $thongbaoFILE; ?></td></tr>
        <tr><td colspan=2><?php echo $thongbaoFILE==='' ?  $thongbao : ''; ?></td></tr>
        <tr>
            <td>Mã truyện:</td>
            <td><input type="text" disabled style='background: #f7e8bc;' size=20  name="matruyen" value="<?php echo $matruyen; ?>"/></td>
        </tr>
        <tr>
            <td>Tên truyện:</td>
            <td><input type="text" size=40 name="tentruyen" value=""/></td>
        </tr>
        <tr>
            <td>Ngày phát hành:</td>
            <td><input type="date" name="ngayphathanh" value="<?php echo $ngayphathanh; ?>"/></td>
        </tr>
        <tr>
            <td>Thể loại:</td>
            <td>
                <select name="theloai" >
                    <?php
                        $query = "SELECT maTL,tenTL FROM theloai";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['maTL'] . '">' . $row['tenTL'] . '</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Series:</td>
            <td>
                <select name="series" >
                    <?php
                        $query = "SELECT maSeries,tenSeries FROM series";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['maSeries'] . '">' . $row['tenSeries'] . '</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tác giả:</td>
            <td>
                <select name="tacgia" >
                    <?php
                        $query = "SELECT maTG,tenTG FROM tacgia";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['maTG'] . '">' . $row['tenTG'] . '</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nhà xuất bản:</td>
            <td>
                <select name="nxb" >
                    <?php
                        $query = "SELECT maNXB,tenNXB FROM nhaxuatban";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['maNXB'] . '">' . $row['tenNXB'] . '</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Số trang:</td>
            <td><input type="number" size=20 name="sotrang" value=""/></textarea></td>
        </tr>
        <tr>
            <td>Ngôn ngữ:</td>
            <td><input type="text" size=20 name="ngonngu" value=""/></textarea></td>
        </tr>
        <tr>
            <td>Mô tả:</td>
            <td><textarea cols=50 rows=5 name="mota"></textarea></td>
        </tr>
        <tr>
            <td>Đơn giá:</td>
            <td><input type="number" size=20 name="dongia" value=""/></td>
        </tr>
        <tr>
            <td>Số lượng tồn:</td>
            <td><input type="number" size=20 name="soluongton" value=""/></td>
        </tr>
        <tr>
            <td>Ảnh bìa:</td>
            <td>
                <input type="file" name="image" />	
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center id='submitRow'>
                <input type='submit' value='Thêm' name='them' id='btnThem'/>
            </td>
        </tr>	
    </table>
        <p align=center><a id="goback" href="./hienthi_Truyen.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_Truyen');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>