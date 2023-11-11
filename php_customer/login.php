<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
    .login-form {
        width: 25rem;
        margin: 0 auto;
        padding: 2rem;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        border-radius: 5%;
    }

    .login-form h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 1rem;
        color: #333;
    }

    .login-form label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #555;
    }

    .login-form input[type="email"],
    .login-form input[type="password"] {
        width: 100%;
        padding: 0.7rem;
        margin-bottom: 2rem;
        border: 1px solid #ccc;
    }

    .login-form button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .login-form button:hover {
        background-color: #0056b3;
    }
</style>

<?php
    $thongbao = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        require("connect.php");

        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, trim($_POST['password'])) : '';

        $query = "SELECT * FROM nguoidung WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $maVT = $user['maVT'];

            $resultVT = mysqli_query($conn, "SELECT tenVT FROM vaitro WHERE maVT='$maVT'");

            $tenVT = '';
            if (mysqli_num_rows($resultVT) <> 0) {
                $vaitro = mysqli_fetch_assoc($resultVT);
                $tenVT = $vaitro['tenVT'];
            } 

            $role = '';
            switch ($tenVT) {
                case 'Admin':
                    $role = 'admin';
                    break;
                case 'Nhân viên':
                    $role = 'nv';
                    break;
                case 'Khách hàng':
                    $role = 'kh';
                    break;
                default:
                    $role = 'kh';
                    break;
            }

            $user_session = array();
            $user_session['id'] = $user['maND'];
            $user_session['role'] = trim($role);
            
            $_SESSION['user'] = $user_session;

            if ($_SESSION['user']['role']==='admin') {
                echo "<script>alert('Xin chào ".$user['hoTen']."');</script>";
                echo '<script>window.location.href = "../php_admin/index.php";</script>';
                exit();
            } elseif ($_SESSION['user']['role']==='nv') {
                echo "<script>alert('Xin chào ".$user['hoTen']."');</script>";
                echo '<script>window.location.href = "../php_admin/index.php";</script>';
                exit();
            } elseif ($_SESSION['user']['role']==='kh') {
                echo "<script>alert('Xin chào ".$user['hoTen']."');</script>";
                echo '<script>window.location.href = "../php_customer/index.php";</script>';
                exit();
            }
        } else {
            $thongbao = "<p align=center><font color=red>Thông tin đăng nhập sai!</font></p>";
        }
    }

    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role']==='admin') {
            echo "<script>alert('Xin chào ".$user['hoTen']."');</script>";
            echo '<script>window.location.href = "../php_admin/index.php";</script>';
            exit();
        } elseif ($_SESSION['user']['role']==='nv') {
            echo "<script>alert('Xin chào ".$user['hoTen']."');</script>";
            echo '<script>window.location.href = "../php_admin/index.php";</script>';
            exit();
        } elseif ($_SESSION['user']['role']==='kh') {
            echo "<script>alert('Xin chào ".$user['hoTen']."');</script>";
            echo '<script>window.location.href = "../php_customer/index.php";</script>';
            exit();
        }
    }
?>

<main>
    <div class="login-form">
        <h2>Đăng nhập</h2>
        <?php echo $thongbao; ?>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Nhập email" required 
                value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"><br><br>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" placeholder="Nhập mật khẩu" name="password" required
                value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>"><br><br>

            <p align=center><button type="submit">Login</button></p>
        </form>
    </div>
</main>

<?php
include('../includes/footer.php');
?>