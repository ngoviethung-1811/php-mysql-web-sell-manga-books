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
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        table {
            width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: gray;
            color: #ffff00;
        }
        th {
            background-color: blue;
            color: yellow;
        }
        h2 {
            text-align: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 5px;
            background-color: #cccc00;
            border: none;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d3d300;
        }
        textarea {
            width: 100%;
            resize: none;
        }
    </style>
<?php
function timkiem($m,$n)
{
    for($i=0;$i<$m;$i++)
    {
        if($m[$i]==$n)
        {
            return "Tìm thấy $n ở vị trí thứ".$i+1;
        }
    }
    return "Không tìm thấy $n trong mảng";
}

?>

<?php 
$kq="";
if(isset($_POST['mang']))
    $mang=$_POST['mang'];
else 
    $mang="";
if(isset($_POST['n']))
    $n=$_POST['n'];
else 
    $n="";
if(isset($_POST['tinh']) && isset($mang) && is_numeric($n))
{
    $m=explode(",",$mang);
    $kq=timkiem($m,$n);
}
else
    echo "Hãy nhập dữ liệu vào ô input";
?>



<form action="" method="post">

<table border="0" cellpadding="0">

    <th colspan="2"><h2>Tìm kiếm</h2></th>

    <tr>

        <td>Nhập mảng:</td>

        <td><input type="text" name="mang" size= "40" value="<?php echo $mang;?> "/></td>

    </tr>
    <tr>

        <td>Nhập số cần tìm:</td>

        <td><input type="text" name="n" size= "10" value="<?php echo $n;?> "/></td>

    </tr>
    <tr>

        <td></td>

        <td ><input type="submit" name="tinh"  size="20" value="TÌm kiếm"/></td>

    </tr>
    <tr>

        <td>Mảng:</td>

        <td><input type="textfield" disabled=disable name="n" size= "40" value="<?php echo $mang;?> "/></td>

    </tr>
    <tr>

        <td>Kết quả tìm kiếm:</td>

        <td><input type="textfield" disabled=disable name="n" size= "30" value="<?php echo $kq;?> "/></td>

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