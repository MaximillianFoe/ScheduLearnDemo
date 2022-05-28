<?php
include('Session.php');
if(empty($_SESSION['userLogin'])) {
    header("location: Index.html");
    die();
}
$isAdminQuery = $conn->query("select YoneticiMi from `userData` where KullaniciAdi = '$kullaniciKontrol'");
$isAdmin = mysqli_fetch_assoc($isAdminQuery);
if(implode(" ",$isAdmin) == 0) {
    header("location: Index.html");
    die();
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" rel="stylesheet">
    <script crossorigin="anonymous"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ScheduLearn User Area</title>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script>
        $(function(){
            $("#Header").load("./Header.php");
            $("#Footer").load("./Footer.html");
        });
    </script>
</head>
<body>
<?php
$conn = mysqli_connect("#Secret", "#Secret", "#Secret", "#Secret");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
<div id="Header"></div>
<div class="row justify-content-center">
    <div class="my-5 col-10">
        <div class="text-center">
            <form method="POST">
                <input class="btn btn-outline-primary my-1" type="submit" value="Get Data" name="submit">
            </form>
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col-2">Month</th>
                    <th scope="col-2">Day</th>
                    <th scope="col-2">Hour</th>
                    <th scope="col-2">User Name</th>
                    <th scope="col-2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_POST['submit'])){
                    $oquery=$conn->query("select * from `TestCompany` where beklemedeMi = 1");
                    while($orow = $oquery->fetch_array()){
                        ?>
                        <tr>
                            <td><?php if ($orow['ayNumarasi'] == 1) echo "January";
                                else if ($orow['ayNumarasi'] == 2) echo "February";
                                else if ($orow['ayNumarasi'] == 3) echo "March";
                                else if ($orow['ayNumarasi'] == 4) echo "April";
                                else if ($orow['ayNumarasi'] == 5) echo "May";
                                else if ($orow['ayNumarasi'] == 6) echo "June";
                                else if ($orow['ayNumarasi'] == 7) echo "July";
                                else if ($orow['ayNumarasi'] == 8) echo "August";
                                else if ($orow['ayNumarasi'] == 9) echo "September";
                                else if ($orow['ayNumarasi'] == 10) echo "October";
                                else if ($orow['ayNumarasi'] == 11) echo "November";
                                else if ($orow['ayNumarasi'] == 12) echo "December";
                                ?></td>
                            <td><?php echo $orow['gun']?></td>
                            <td><?php if (str_contains($orow['saat'], ".5")) {
                                    echo rtrim($orow['saat'], "5") . "30"; }
                                else {
                                    echo $orow['saat'];
                                }
                                ?></td>
                            <td><?php echo $orow['userName']; ?></td>
                            <td>
                                <button type="button" class="btn btn-info">Accept</button>
                                <button type="button" class="btn btn-info">Reject</button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        </br></div>
    <div id="Footer"></div>
</body>
</html>