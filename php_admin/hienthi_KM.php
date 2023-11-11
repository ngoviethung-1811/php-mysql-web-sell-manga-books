<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/hienthi.css">

<?php
    require("connect.php");
    
    $rowsPerPage=10;
    if (!isset($_GET['page'])) $_GET['page'] = 1;
    $offset =($_GET['page']-1)*$rowsPerPage;

    $result = mysqli_query($conn, "SELECT khuyenmai.*,
        loaikhuyenmai.tenLKM
        FROM khuyenmai
        JOIN loaikhuyenmai ON khuyenmai.maLKM = loaikhuyenmai.maLKM
        ORDER BY maKM LIMIT $offset, $rowsPerPage");
    $noidungBang = '';

    if(mysqli_num_rows($result)<>0) {
        $stt=1;
        while($rows=mysqli_fetch_assoc($result)) {
            if ($stt%2==0) $noidungBang .= "<tr style='background-color: #b9e7f0;'>";
            else $noidungBang .= "<tr>";

            $noidungBang .= "<td class='centerText'>" . $rows['maKM'] . "</td>";
            $noidungBang .= "<td>" . $rows['tenLKM'] . "</td>";
            $noidungBang .= "<td>" . $rows['code'] . "</td>";

            if ($rows['tenLKM'] === 'Khuyến mãi %')
                $noidungBang .= "<td>" . number_format($rows['giamGia'], 0, ",", ".") . "%</td>";
            elseif ($rows['tenLKM'] === 'Khuyến mãi Giá')
                $noidungBang .= "<td>" . number_format($rows['giamGia'], 0, ",", ".") . "đ</td>";
            $noidungBang .= "<td>" . number_format($rows['gtDonHang'], 0, ",", ".") . "đ</td>";

            $noidungBang .= "<td class='centerText'>" . date("d/m/Y", strtotime($rows['ngayBD'])) . "</td>";
            $noidungBang .= "<td class='centerText'>" . date("d/m/Y", strtotime($rows['ngayKT'])) . "</td>";

            $noidungBang .= "<td>
                <a href=./sua_KM.php?id=".$rows['maKM'].">
                    <img src='../images/icon_edit.png' title='Sửa' style='height:1rem;'>
                </a>
                <a href=./xoa_KM.php?id=".$rows['maKM'].">
                    <img src='../images/icon_delete.png' title='Xoá' style='height:1rem;'>
                </a>
                </td>";
            $noidungBang .= "</tr>";

            $stt++;
        }
    }
    else {
        $noidungBang .= "<td colspan=8>Không có bản ghi</td>";
    }

    $re = mysqli_query($conn, 'select * from khuyenmai');
    $numRows = mysqli_num_rows($re);
    $maxPage = ceil($numRows/$rowsPerPage);

    $phanTrang = "";

    if ($_GET['page'] > 1) {
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
    }
    else {
        $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=1> << </a>";
        $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> < </a>";
    }
    for ($i=1 ; $i<=$maxPage ; $i++){ 
        if ($i == $_GET['page'])
            $phanTrang .= "<a class='active'>".$i."</a>";
        else
            $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">".$i."</a>";
    }
    if ($_GET['page'] < $maxPage) {
        $phanTrang .= "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
        $phanTrang .= "<a href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
    }
    else {
        $phanTrang .= "<a class='disable' href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> > </a>";
        $phanTrang .= "<a class='disable' href=" .$_SERVER['PHP_SELF']."?page=".$maxPage."> >> </a>";
    }
?>

<?php
    if (isset($_POST['loaiKM']))
        $loaiKM = $_POST['loaiKM'];
    else $loaiKM = 'all';
    if (isset($_POST['ngayDau']))
        $ngayDau = $_POST['ngayDau'];
    else $ngayDau = date('Y-m-d', strtotime('-5 years'));
    if (isset($_POST['ngayCuoi']))
        $ngayCuoi = $_POST['ngayCuoi'];
    else $ngayCuoi = date('Y-m-d');

    $resLKM = mysqli_query($conn, "SELECT * FROM loaikhuyenmai");
    if(mysqli_num_rows($resLKM)<>0) {
        $inputLKM = "<select name='loaiKM'>";
        $inputLKM .= "<option value='all' selected>Tất cả</option>";
        while($rows=mysqli_fetch_assoc($resLKM)){
            $selected = '';
            if(isset($_GET['loaiKM']) && $_GET['loaiKM']==$rows['maLKM']) $selected = 'selected';
            $inputLKM .= "<option value=${rows['maLKM']} ".$selected.">
                    ${rows['tenLKM']}
                    </option>";
        }
        $inputLKM .= "</select>";
    }
?>

<main>
    <p id='pageCaption'>THÔNG TIN KHUYẾN MÃI</p>
    <p align=center><a id="btnThem" href="them_KM.php">Thêm khuyến mãi</a></p>
    <p align=center><button id='btnTimKiemForm' onclick="showSearchForm()">Tìm kiếm</button></p>
    <form id='formTimKiem' action="tim_KM.php" method="post" style="display: none;">
        <table id='tableTimKiem'>
            <tr>
                <td>Loại khuyến mãi:</td>
                <td><?php echo $inputLKM; ?></td>
            </tr>
            <tr>
                <td>Ngày đầu:</td>
                <td><input type="date" name="ngayDau" value="<?php echo $ngayDau; ?>"></td>
            </tr>
            <tr>
                <td>Ngày cuối:</td>
                <td><input type="date" name="ngayCuoi" value="<?php echo $ngayCuoi; ?>"></td>
            </tr>
            <tr>
                <td colspan=2 align=center>
                    <input type='button' value='Huỷ' name='huy' id='btnHuy' onclick='hideSearchForm()'/>
                    <input type='submit' name='tim' value='Tìm' id='btnTim'>
                    <input type='reset' name='reset' value='Làm mới' id='btnReset'>
                </td>
            </tr>
        </table>
    </form>
    <table border='1'>
        <tr>
            <th>Mã khuyến mãi</th>
            <th>Loại khuyến mãi</th>
            <th>Code</th>
            <th>Giảm giá</th>
            <th>Giá trị đơn hàng</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Thao tác</th>
        </tr>
        <?php echo $noidungBang; ?>
    </table>
    <div style='text-align: center; margin: 0.2rem;'>
        <div class='pagination'><?php echo $phanTrang; ?></div>
    </div>
</main>

<script>
    var tab = document.getElementById('hienthi_KM');
    tab.classList.add('active');
</script>

<script src="../javascript/hienthi_form_timkiem.js"></script>

<?php
include('../includes/footer.php');
?>