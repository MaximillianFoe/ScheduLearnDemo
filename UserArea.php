<?php
include('Session.php');
if(empty($_SESSION['userLogin'])) {
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
    <span class="text-center">Current Month: <?php echo date('F'); ?></span>
    <form method="POST">
        <label>Day, From:&nbsp;</label><label>
            <input class="form-control" type="number" name="from" min="1" max="31" value="1">
        </label>
        <label>To:&nbsp;</label><label>
            <input class="form-control" type="number" name="to" min="1" max="31" value="31">
        </label>
        <br><label>Hour:&nbsp;</label><label>
            <input class="form-control" type="time" name="timeFrom" step="1800">
        </label>
        <input class="btn btn-outline-primary my-1" type="submit" value="Get Data" name="submit">
    </form>
</div>
<div>
    <table class="table">
        <thead>
        <tr>
            <th class="col-2">Month</th>
            <th class="col-2">Day</th>
            <th class="col-2">Hour</th>
            <th class="col-2">Is Available?</th>
            <th class="col-2">Take</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_POST['TakeApp'])) {
            sendQuery();
        }
        if (isset($_POST['submit'])){
            $from=$_POST['from'];
            $to=$_POST['to'];
            $hangiAydayiz = date("n");
            $oquery=$conn->query("select * from `TestCompany` where gun between '$from' and '$to' AND ayNumarasi = '$hangiAydayiz'");
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
                    <td><?php if ($orow['uygunMu'] == 0) echo "No";
                        else if ($orow['uygunMu'] == 1) echo "Yes";
                        ?></td>
                    <td><?php if ($orow['uygunMu'] == 1) { ?>
                        <form method="post">
                        <input type="submit" class="button btn btn-info" name="TakeApp" id="TakeApp" value="Take" onClick="return sendValue(<?php echo $orow['ayNumarasi']?>,<?php echo $orow['gun']?>,<?php echo $orow['saat']?>);"/>
                        </form>
                        <?php } ?>
                        <?php if ($orow['uygunMu'] == 0) { ?>
                            <input type="submit" class="button btn btn-info" name="TakeApp" value="Take" disabled/>
                        <?php } ?>
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
<script>
    function sendValue(hangiAy, hangiGun, hangiSaat)
    {
        window.location.href = "Query.php?Ay=" + hangiAy + "&Gun=" + hangiGun + "&Saat=" + hangiSaat;
        return false;
    }
</script>
</html>