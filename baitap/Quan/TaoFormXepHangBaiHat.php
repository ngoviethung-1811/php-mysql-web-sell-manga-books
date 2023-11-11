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
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        table {
            border: 2px solid #d40d9b;
            width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
        }
        thead {
            background: #d40d9b;
        }
        h3 {
            text-align: center;
            color: white;
            font-size: 18px;
        }
        .input_field {
            background: #f0d8e9;
            text-align: right;
            font-weight: bold;
        }
        .output_field {
            background: #f0995b;
            text-align: center;
            font-weight: bold;
        }
        textarea {
            width: 100%;
            resize: none;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
        }
        input[type="submit"] {
            background: #cccc00;
            padding: 5px 20px;
            border: none;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #d3d300;
        }
    </style>

    <?php 
        if(isset($_POST['tenBai']))  
            $tenBai=trim($_POST['tenBai']); 
        else $tenBai='';
        if(isset($_POST['hang']))  
            $hang=trim($_POST['hang']); 
        else $hang='';
        if(isset($_POST['dsBaiHat']))  
            $dsBaiHat=trim($_POST['dsBaiHat']); 
        else $dsBaiHat='';
        if(isset($_POST['bxh']))  
            $bxh=trim($_POST['bxh']); 
        else $bxh='';

        session_start();

        function themBaiHat($name, $rank) {
            if(isset($_SESSION['data'])) 
                $data = $_SESSION['data'];
            else $data = array();

            if (count($data) == 0) {
                $isExist = false;
            }
            else {
                $isExist = false;
                foreach ($data as $key => $value) {
                    if ($value == $name) {
                        $isExist = true;
                        break;
                    }
                }
            }

            if ($isExist) {
                echo "<font color='red'>Bài hát đã tồn tại!</font>"; 
            }
            else {
                if (array_key_exists($rank, $data)) {
                    echo "<font color='red'>Thứ hạng đã tồn tại!</font>"; 
                }
                else {
                    $data["$rank"] = $name;
                    $_SESSION['data'] = $data;
                }
            }
        }

        function hienThiDSBaiHat() {
            if(isset($_SESSION['data'])) 
                $data = $_SESSION['data'];
            else $data = array();

            if (count($data) == 0) return '';

            $str = "Danh sách bài hát: \n\n";

            foreach ($data as $rank => $name) {
                $str .= $rank . ". " . $name . "\n";
            }

            return $str;
        }

        function hienThiBXH() {
            if(isset($_SESSION['data'])) 
                $data = $_SESSION['data'];
            else $data = array();

            if (count($data) == 0) return '';

            ksort($data);

            $str = '';
            $str .= '<table>
                        <tr>
                            <td colspan="2" align="center" style="background: green;"><h4>BẢNG XẾP HẠNG BÀI HÁT</h4></td>
                        </tr>';
            $str .= "<tr>
                        <td style='background: blue;'>Xếp hạng</td>
                        <td style='background: blue;'>Tên bài hát</td>
                    </tr>";

            foreach ($data as $rank => $name) {
                $str .= "<tr>
                            <td class='output_field'>$rank</td>
                            <td class='output_field'>$name</td>
                        </tr>";
            }

            $str .= '</table>';

            return $str;
        }
        
        if(isset($_POST['them'])) {
            if ($tenBai != '' && $hang != '') {
                if (is_numeric($hang)) {
                    themBaiHat($tenBai, $hang);
                    $dsBaiHat = hienThiDSBaiHat();
                }
                else {
                    echo "<font color='red'>Vui lòng nhập thứ hạng là số!</font>"; 
                }
            }
            else {
                echo "<font color='red'>Vui lòng nhập đầy đủ thông tin!</font>"; 
            }
        }
        elseif (isset($_POST['hienthi'])) {
            $bxh = hienThiBXH();
        }
        else {
            $dsBaiHat = '';
            $bxh = '';
        }

        if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > 300)) { 
            session_destroy();
            session_unset();
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    ?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="2"><h3>XẾP HẠNG BÀI HÁT</h3></th>
            </thead>
            <tr>
                <td class="input_field">Tên bài hát: </td>
                <td class="input_field"><input type="text" name="tenBai" value="<?php  echo $tenBai;?> "/></td>
            </tr>
            <tr>
                <td class="input_field">Thứ hạng: </td>
                <td class="input_field"><input type="text" name="hang" value="<?php  echo $hang;?> "/></td>
            </tr>
            <tr>
                <td class="input_field" colspan="2"> <input type="submit" value="Thêm bài hát" name="them" /> <input type="submit" value="Hiển thị bảng xếp hạng" name="hienthi" /> </td>
            </tr>
            <tr></tr>
            <tr>
                <td class="input_field" colspan="2">
                    <textarea cols="80" rows="10" name="dsBaiHat" disabled> <?php echo $dsBaiHat?></textarea>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td class="input_field" colspan="2"><?php echo $bxh?></td>
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