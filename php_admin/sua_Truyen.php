<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/sua.css">

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

    if (isset($_GET['id'])) {
        $maTruyen = $_GET['id'];
        $thongbao = '';
        $thongbaoFILE = '';

        if(isset($_POST['capnhat'])) 
        {
            $tenTruyen = trim($_POST['tentruyen']);
            $maTL = $_POST['theloai'];
            $maTG = $_POST['tacgia'];
            $maNXB = $_POST['nxb'];
            $maSeries = $_POST['series'];
            $moTa = trim($_POST['mota']);
            $ngayPhatHanh = $_POST['ngayphathanh'];
            $donGia = trim($_POST['dongia']);
            $soLuongTon = trim($_POST['soluongton']);
            $soTrang = trim($_POST['sotrang']);
            $ngonNgu = trim($_POST['ngonngu']);

            $errors = array();

            if(isset($_FILES['image'])!=NULL && $_FILES['image']['size']!=0 )
            {
                $file_name = $_FILES['image']['name'];
                $anhbia=$file_name;
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=@strtolower(end(explode('.',$_FILES['image']['name'])));
                $expensions= array("jpeg","jpg","png");
                
                if(in_array($file_ext,$expensions)=== false){
                    $errors[]="Chỉ nhận file ảnh JPEG, JPG, PNG.";
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
            else $file_name = "";

            if (empty($errors) == true) {
                if ($file_name != "")
                    $txtAnhBia = "anhBia = '$file_name',";
                else $txtAnhBia = "";

                $sql = "UPDATE truyen SET tenTruyen = '$tenTruyen', 
                                        maTL = '$maTL', 
                                        maTG = '$maTG', 
                                        maNXB = '$maNXB', 
                                        maSeries = '$maSeries', 
                                        moTa = '$moTa', 
                                        ngayPhatHanh = '$ngayPhatHanh', 
                                        donGia = '$donGia', 
                                        soLuongTon = '$soLuongTon', 
                                        $txtAnhBia
                                        soTrang = '$soTrang', 
                                        ngonNgu = '$ngonNgu' 
                        WHERE maTruyen = '$maTruyen'";
                $result = mysqli_query($conn, $sql);
                if ($result) 
                {
                    $tentruyen=$tenTruyen;
                    $matacgia= $maTG;
                    $matheloai= $maTL;
                    $maseries= $maSeries;
                    $mota= $moTa;
                    $manxb= $maNXB;
                    $ngayphathanh= $ngayPhatHanh;
                    $sotrang= $soTrang;
                    $ngonngu= $ngonNgu;
                    $dongia= $donGia;
                    $soluongton= $soLuongTon;
                    $thongbao = "<p align=center><font color=green>Cập nhật thành công!</font></p>";
                }
                else $thongbao = "<p align=center><font color=red>Cập nhật không thành công!</font></p>";
            }
        }

        $query = "SELECT * 
                FROM truyen 
                WHERE maTruyen = '$maTruyen'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <> 0) {
            $row = mysqli_fetch_assoc($result);
            $tentruyen=$row['tenTruyen'];
            $matacgia= $row['maTG'];
            $matheloai= $row['maTL'];
            $maseries= $row['maSeries'];
            $mota= $row['moTa'];
            $manxb= $row['maNXB'];
            $ngayphathanh= $row['ngayPhatHanh'];
            $sotrang= $row['soTrang'];
            $ngonngu= $row['ngonNgu'];
            $dongia= $row['donGia'];
            $soluongton= $row['soLuongTon'];
            $anhbia= $row['anhBia'];
        } else {
            $tentruyen='';
            $matacgia= '';
            $matheloai= '';
            $maseries= '';
            $mota= '';
            $manxb= '';
            $ngayphathanh= '';
            $sotrang= '';
            $ngonngu= '';
            $dongia= '';
            $soluongton= '';
            $anhbia= '';
        }
    } else {
        header("Location: ../html/not_found.html");
    }

?>

<main>
    <p id='pageCaption'>SỬA TRUYỆN</p>
    <form  action="" method="post" enctype="multipart/form-data">
    <table >
        <tr><td colspan=2><?php echo $thongbaoFILE; ?></td></tr>
        <tr><td colspan=2><?php echo $thongbaoFILE==='' ?  $thongbao : ''; ?></td></tr>
        <tr>
            <td>Mã truyện:</td>
            <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="matruyen" value="<?php echo $maTruyen; ?>"/></td>
        </tr>
        <tr>
            <td>Tên truyện:</td>
            <td><input type="text" size=40 name="tentruyen" value="<?php echo $tentruyen; ?>"/></td>
        </tr>
        <tr>
            <td>Ngày phát hành:</td>
            <td><input type="date" name="ngayphathanh" value="<?php echo $ngayphathanh; ?>" /></td>
        </tr>
        <tr>
            <td>Thể loại:</td>
            <td>
                <select name="theloai" >
                    <?php
                        $query = "SELECT maTL,tenTL FROM theloai";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            if($row['maTL'] ==$matheloai)
                            {
                                echo '<option value="' . $row['maTL'] . '"selected>' . $row['tenTL'] . '</option>';
                            }
                            else
                            {
                                echo '<option value="' . $row['maTL'] . '">' . $row['tenTL'] . '</option>';
                            }
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
                            if($row['maSeries'] ==$maseries)
                            {
                                echo '<option value="' . $row['maSeries'] . '"selected>' . $row['tenSeries'] . '</option>';
                            }
                            else
                            {
                                echo '<option value="' . $row['maSeries'] . '">' . $row['tenSeries'] . '</option>';
                            }
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
                            if($row['maTG'] ==$matacgia)
                            {
                                echo '<option value="' . $row['maTG'] . '"selected>' . $row['tenTG'] . '</option>';
                            }
                            else
                            {
                                echo '<option value="' . $row['maTG'] . '">' . $row['tenTG'] . '</option>';
                            }
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
                            if($row['maNXB'] ==$manxb)
                            {
                                echo '<option value="' . $row['maNXB'] . '"selected>' . $row['tenNXB'] . '</option>';
                            }
                            else
                            {
                                echo '<option value="' . $row['maNXB'] . '">' . $row['tenNXB'] . '</option>';
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Số trang:</td>
            <td><input type="number" size=20 name="sotrang" value="<?php echo $sotrang; ?>"/></textarea></td>
        </tr>
        <tr>
            <td>Ngôn ngữ:</td>
            <td><input type="text" size=20 name="ngonngu" value="<?php echo $ngonngu; ?>"/></textarea></td>
        </tr>
        <tr>
            <td>Mô tả:</td>
            <td><textarea cols=50 rows=5 name="mota"><?php echo $mota; ?></textarea></td>
        </tr>
        <tr>
            <td>Đơn giá:</td>
            <td><input type="number" size=20 name="dongia" value="<?php echo $dongia; ?>"/></td>
        </tr>
        <tr>
            <td>Số lượng tồn:</td>
            <td><input type="number" size=20 name="soluongton" value="<?php echo $soluongton; ?>"/></td>
        </tr>
        <tr>
            <td>Ảnh bìa:</td>                
            <td>
                <input type="file" name="image" />	
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center id='submitRow'>
                <input type='submit' value='Cập nhật' name='capnhat' id='btnCapNhat'/>
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