<?php
include('../includes/admin_header.html');
?>

<link rel="stylesheet" href="../css/admin_index.css">

<h1>Thành viên nhóm</h1>
<div class="members-container">
  <div class="member">
    <a href="../baitap/hienthi_BaiTap.php?tenTV=Hung">
      <p align=center><img src="../images/anhthanhvien/hung.jpg" /></p>
      <div class="member-content">
      <h2>Thành viên 1</h2>
      <p>Ngô Việt Hưng</p>
      <p>62133766</p>
      </div>
    </a>
  </div>
  <div class="member">
    <a href="../baitap/hienthi_BaiTap.php?tenTV=Trong">
      <p align=center><img src="../images/anhthanhvien/trong.jpg" /></p>
      <div class="member-content">
      <h2>Thành viên 2</h2>
      <p>Lê Đức Trọng</p>
      <p>62134401</p>
      </div>
    </a>
  </div>
  <div class="member">
    <a href="../baitap/hienthi_BaiTap.php?tenTV=Quan">
      <p align=center><img src="../images/anhthanhvien/quan.jpg" /></p>
      <div class="member-content">
      <h2>Thành viên 3</h2>
      <p>Nguyễn Minh Quân</p>
      <p>62134131</p>
      </div>
    </a>
  </div>
  <div class="member">
    <a href="../baitap/hienthi_BaiTap.php?tenTV=Quang">
      <p align=center><img src="../images/anhthanhvien/quang.jpg" /></p>
      <div class="member-content">
      <h2>Thành viên 4</h2>
      <p>Nguyễn Hoàng Đăng Quang</p>
      <p>62134138</p>
      </div>
    </a>
  </div>
  <div class="member">
    <a href="../baitap/hienthi_BaiTap.php?tenTV=Tung">
      <p align=center><img src="../images/anhthanhvien/tung.jpg" /></p>
      <div class="member-content">
      <h2>Thành viên 5</h2>
      <p>Nguyễn Hoàng Tùng</p>
      <p>62134451</p>
      </div>
    </a>
  </div>
</div>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>