<?php
    include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/them.css">

<?php
    if ($_SESSION['user']['role']!='admin'){
        header('Location: ../html/permission_denied.html');
        exit();
    }
?>

<?php
    require("connect.php");

    function taoMaND() {
        GLOBAL $conn;

        $sql = "SELECT MAX(maND) AS maND_max FROM nguoidung";
        $result = mysqli_query($conn, $sql);
        $idMax = mysqli_fetch_assoc($result)["maND_max"];

        $idND = intval(substr($idMax, 2)) + 1;

        $ND = str_pad($idND, 5, "0", STR_PAD_LEFT);

        return "nd" . $ND;
    }

    function emailExist($email) {
        GLOBAL $conn;

        $sql = "SELECT maND FROM nguoidung WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        return mysqli_num_rows($result)<>0;
    }

    $mand = taoMaND();
    $thongbao = '';

    if(isset($_POST['tennd']))  
        $tennd=trim($_POST['tennd']);
    else $tennd='';

    if(isset($_POST['email']))  
        $email=trim($_POST['email']); 
    else $email='';

    if(isset($_POST['password']))  
        $password=trim($_POST['password']); 
    else $password='';

    if(isset($_POST['vaitro']))  
        $vaitro=$_POST['vaitro']; 
    else $vaitro='';

    if(isset($_POST['diachi']))  
        $diachi=$_POST['diachi']; 
    else $diachi='';

    if(isset($_POST['sdt']))  
        $sdt=trim($_POST['sdt']); 
    else $sdt='';

    if(isset($_POST['them']))
    {
        if($tennd=='' || $email=='' || $password=='' || $vaitro=='' || $diachi=='' || $sdt=='')
        {
            $thongbao = "<p align=center><font color=red>Vui lòng nhập đầy đủ dữ liệu!</font></p>";
        }
        else
        {
            if (emailExist($email))
                $thongbao = "<p align=center><font color=red>Email đã tồn tại!</font></p>";
            else {
                $sql = "INSERT INTO nguoidung (maND, maVT, hoTen, email, password, diaChi, sdt) 
                    VALUES ('$mand', '$vaitro', '$tennd', '$email', '$password', '$diachi', '$sdt')";
                $result = mysqli_query($conn, $sql);
                if ($result) 
                {
                    $thongbao = "<p align=center><font color=green>Thêm thành công!</font></p>";
                    $mand = taoMaND();
                }
                else $thongbao = "<p align=center><font color=red>Thêm không thành công!</font></p>";
            }
        }        
    }
?>

<main>
    <p id='pageCaption'>THÊM NGƯỜI DÙNG</p>
    <form  action="" method="post">
        <table>
            <tr><td colspan=2><?php echo $thongbao; ?></td></tr>
            <tr>
                <td>Mã người dùng:</td>
                <td><input type="text" disabled style='background: #f7e8bc;' size=20 name="mand" value="<?php echo $mand; ?>"/></td>
            </tr>
            <tr>
                <td>Tên người dùng:</td>
                <td><input type="text" size=40 name="tennd" value=""/></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" size=40 name="email" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" size=40 name="password" value=""/></td>
            </tr>
            <tr>
                <td>Vai trò:</td>
                <td>
                    <select name="vaitro" >
                        <?php

                            $query = "SELECT maVT,tenVT FROM vaitro";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['maVT'] . '">' . $row['tenVT'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" size=40 name="diachi" value=""/></textarea></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" size=20 name="sdt" value=""/></textarea></td>
            </tr>
            <tr>
                <td colspan=2 align=center id='submitRow'>
                    <input type='submit' value='Thêm' name='them' id='btnThem'/>
                </td>
            </tr>
        </table>
        <p align=center><a id="goback" href="./hienthi_NguoiDung.php">Quay lại</a></p>
    </form>
</main>

<script>
    var tab = document.getElementById('hienthi_NguoiDung');
    tab.classList.add('active');
</script>

<?php
    include('../includes/footer.php');
?>