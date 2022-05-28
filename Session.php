<?php
    $conn = mysqli_connect("#Secret", "#Secret", "#Secret, "#Secret");
    session_start();
    $kullaniciKontrol = $_SESSION['userLogin'];
    $query = "SELECT KullaniciAdi from userData where KullaniciAdi = '$kullaniciKontrol'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $loginSession = $row['KullaniciAdi'];
?>