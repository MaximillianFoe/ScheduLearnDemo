<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Username']) && isset($_POST['Name'])
        && isset($_POST['surName'])
        && isset($_POST['Password'])
        && isset($_POST['e-Mail'])) {

        $KullaniciAdi = $_POST['Username'];
        $Ad = $_POST['Name'];
        $Soyad = $_POST['surName'];
        $KullaniciSifre = $_POST['Password'];
        $ePosta = $_POST['e-Mail'];
        $companyName = $_POST['CompanyName'];
        $profilePicture = "./UserData/ProfilePictures/Default.png";
        $YoneticiMi = "0";
        $mailOnay = "0";

        $host = "#Secret";
        $dbUsername = "#Secret";
        $dbPassword = "#Secret";
        $dbName = "#Secret";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT ePosta FROM userData WHERE ePosta = ? LIMIT 1";
            $Insert = "INSERT INTO userData(KullaniciAdi, Ad, Soyad, KullaniciSifre, ePosta, companyName, profilePicture, mailOnay, YoneticiMi) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $ePosta);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssssssii",$KullaniciAdi,$Ad, $Soyad, $KullaniciSifre, $ePosta, $companyName, $profilePicture, $mailOnay, $YoneticiMi);
                if ($stmt->execute()) {
                    echo "Registered Succesfully to ScheduLearn!";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already using this email!";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All fields are required!";
        die();
    }
}
else {
    echo "Submit button is not set!";
}
