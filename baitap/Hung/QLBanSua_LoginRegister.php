<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>
<style>
  body {font-family: Arial, Helvetica, sans-serif;}

  /* Full-width input fields */
  input[type=text], input[type=password], input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  /* Set a style for all buttons */
  button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
  }

  button:hover {
    opacity: 0.8;
  }

  /* Extra styles for the cancel button */
  .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
  }

  /* Center the image and position the close button */
  .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
  }

  img.avatar {
    width: 40%;
    border-radius: 50%;
  }

  .container {
    padding: 16px;
  }

  span.psw {
    float: right;
    padding-top: 16px;
  }

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
  }

  /* The Close Button (x) */
  .close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: red;
    cursor: pointer;
  }

  /* Add Zoom Animation */
  .animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
  }

  @-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
  }
    
  @keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
  }

  /* Change styles for span and cancel button on extra small screens */
  @media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
  }

  #qlbsContent {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
</style>
<main>
<?php

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if (isset($_POST['btnLogin'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  require("QLBanSua_connect.php");
  $result = mysqli_query($conn, "SELECT username, password FROM user");

  if(mysqli_num_rows($result)<>0) {
    $loginSuccess = false;
    while($rows=mysqli_fetch_row($result)) {
      if ($rows[0]===$username && $rows[1]===$password) {
        $loginSuccess = true;
        break;
      }
    }

    if ($loginSuccess) {
      header("Location: QLBanSua_HienThiTTSanPham.php");
    }
    else {
      alert("Login Failed");
    }
  }
}
if (isset($_POST['btnRegister'])) {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  require("connect.php");
  $result = mysqli_query($conn, "SELECT email FROM user");

  if(mysqli_num_rows($result)<>0) {
    $registerSuccess = true;
    while($rows=mysqli_fetch_row($result)) {
      if ($rows[0]===$email) {
        $registerSuccess = false;
        break;
      }
    }

    if ($registerSuccess) {
      mysqli_query($conn, "INSERT INTO user (user_id, username, email, password) VALUES (NULL, '$username', '$email', '$password')");
      alert("Register Successfully");
    }
    else {
      alert("The email has already been taken");
    }
  }
}
?>

<div id="qlbsContent">
<h2 id="page_name">MILKY</h2>

<button onclick="document.querySelector('#login_modal').style.display='block'" style="width:auto;">Login</button>
<button onclick="document.querySelector('#register_modal').style.display='block'" style="width:auto; background-color: orange;">Register</button>

<div id="login_modal" class="modal">    
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.querySelector('#login_modal').style.display='none'" class="close" title="Close">&times;</span>
      LOGIN
    </div>
    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit" name="btnLogin">Login</button>
    </div>
  </form>
</div>

<div id="register_modal" class="modal">    
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.querySelector('#register_modal').style.display='none'" class="close" title="Close">&times;</span>
      REGISTER
    </div>
    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit" name="btnRegister" style="background-color: orange;">Register</button>
    </div>
  </form>
</div>

<script>
// Get the modal
const loginModal = document.querySelector('#login_modal');
const registerModal = document.querySelector('#register_modal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
}
</script>
</div>
</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>