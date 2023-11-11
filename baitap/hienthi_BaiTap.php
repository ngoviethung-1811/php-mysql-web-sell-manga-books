<?php
include('../includes/admin_header.html');
?>

<style>
    main {
        padding: 1rem;
    }
    h1,h3  {
        text-align: center;
    }
    h3 {
        color: green;
        margin: 0.5rem;
    }
    ul {
        list-style-type: none;
    }
    li {
        padding: 0.5rem;
    }
    .linkbt {
        text-decoration: none;
        color: blue;
        opacity: 0.7;
    }
    .linkbt:hover {
        opacity: 1;
    }
    #khungBT {
        text-align: center;
        padding: 1rem;
    }
</style>

<?php
    if (isset($_GET['tenTV'])) {
        $tenTV = $_GET['tenTV'];

        switch ($tenTV) {
            case 'Hung':
                $hoTenTV = 'Ngô Việt Hưng';
                break;
            case 'Trong':
                $hoTenTV = 'Lê Đức Trọng';
                break;
            case 'Quan':
                $hoTenTV = 'Nguyễn Minh Quân';
                break;
            case 'Quang':
                $hoTenTV = 'Nguyễn Hoàng Đăng Quang';
                break;
            case 'Tung':
                $hoTenTV = 'Nguyễn Hoàng Tùng';
                break;
            default:
                break;
        }
    }
    else {
        header("Location: ../html/not_found.html");
    }
?>

<main>
    <h1>BÀI TẬP CÁ NHÂN</h1>
    <h3><?php echo $hoTenTV; ?></h3>
    <div id='khungBT'>
        <ul>
            <?php
                $folder = "$tenTV";
                $files = scandir($folder);
                
                $stt = 1;
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                        echo "<li><a class='linkbt' href='$folder/$file'>Bài $stt - $file</a></li>";
                        $stt++;
                    }
                }
            ?>
        </ul>
    </div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>