<?php
session_start();
$error = '';
if (isset($_POST['LoginSubmit'])) {
    if (empty($_POST['loginUsername']) || empty($_POST['loginPassword'])) {
        $error = "Username or Password Is Invalid!";
    }
    else{
        $KullaniciAdi = $_POST['loginUsername'];
        $KullaniciSifre = $_POST['loginPassword'];
        $conn = mysqli_connect("#Secret", "#Secret", "#Secret", "ScheduLearn");
        $query = "SELECT KullaniciAdi, KullaniciSifre from userData where KullaniciAdi=? AND KullaniciSifre=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $KullaniciAdi, $KullaniciSifre);
        $stmt->execute();
        $stmt->bind_result($KullaniciAdi, $KullaniciSifre);
        $stmt->store_result();
        if($stmt->fetch())
            $_SESSION['userLogin'] = $KullaniciAdi;
        header("location: UserArea.php");
    }
    mysqli_close($conn);
}