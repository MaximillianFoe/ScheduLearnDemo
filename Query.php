<?php
include('Session.php');
if(empty($_SESSION['userLogin'])) {
    header("location: Index.html");
    die();
}
function sendQuery(): void
{
    $conn = mysqli_connect("#Secret", "#Secret", "#Secret", "#Secret");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    $ayNumarasi = $_GET['Ay'];
    $gunNumarasi = $_GET['Gun'];
    $saatNumarasi = $_GET['Saat'];
    echo $ayNumarasi;
    $kullaniciAdi = strval($_SESSION['userLogin']);
    $UpdateQuery = "UPDATE TestCompany SET userName='$kullaniciAdi', uygunMu = 0, beklemedeMi = 1 WHERE ayNumarasi = '$ayNumarasi' AND gun = '$gunNumarasi' AND saat = '$saatNumarasi'";
    $conn->query($UpdateQuery);
    $conn->close();
}
sendQuery();
