<?php include('Session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="Header.css">
    <title>Header</title>
</head>
<?php
$conn = mysqli_connect("#Secret", "#Secret", "#Secret", "#Secret");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$kullaniciKontrol = $_SESSION['userLogin'];
?>
<header class="col-12 p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none" href="Index.html">
                <img alt="ScheduLearn Logo" src="SL_Logo.png" width="130" height="76">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 mx-3 justify-content-center mb-md-0">
                <li><a class="nav-link px-3 text-secondary" href="Index.html">Home</a></li>
                <li><a class="nav-link px-3 text-white" href="./About.html">About Us</a></li>
                <li><a class="nav-link px-3 text-white" href="./Contact.html">Contact Us</a></li>
            </ul>
            <?php if(empty($_SESSION['userLogin'])) { ?>
            <div class="text-end">
            <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="modal" data-bs-target="#loginForm">Login</button>
            <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#registerForm">Sign-up</button>
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['userLogin'])) { ?>
                <?php $profilePictureURL=$conn->query("select profilePicture from `userData` where KullaniciAdi = '$kullaniciKontrol'");
                $PPURL =  mysqli_fetch_assoc($profilePictureURL);?>
                <div class="text-end">
                    <span class="badge rounded-pill bg-info text-dark col-3"><?php echo $kullaniciKontrol ?></span>
                    <img src="<?php echo implode(" ",$PPURL) ?>" class="rounded col-3" alt="Profile Picture">
                    <a class="btn btn-outline-primary" type="button" href="Logout.php">Log Out</a>
                </div>
            <?php } ?>
        </div>
    </div>
</header>
<div class="modal fade" id="loginForm" tabindex="-1" aria-labelledby="LoginForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginFormTitle">ScheduLearn Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="Login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <label for="loginUsername"></label><input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Username" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <label for="loginPassword"></label><input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password" />
                    </div>
                    <div class="modal-footer d-block">
                        <p class="float-start">Not Yet Account <a href="" data-bs-toggle="modal" data-bs-target="#registerForm">Sign Up</a></p>
                        <button type="submit" class="btn btn-warning float-end" name="LoginSubmit">Login!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registerForm" tabindex="-1" aria-labelledby="RegisterForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerFormTitle">ScheduLearn Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="Insert.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <label for="Username"></label><input type="text" class="form-control" id="Username" name="Username" placeholder="Username" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <label for="Name"></label><input type="text" class="form-control" id="Name" name="Name" placeholder="Name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Surname</label>
                        <label for="surName"></label><input type="text" class="form-control" id="surName" name="surName" placeholder="Surname" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-Mail</label>
                        <label for="e-Mail"></label><input type="text" class="form-control" id="e-Mail" name="e-Mail" placeholder="E-Mail" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <label for="Password"></label><input type="password" class="form-control" id="Password" name="Password" placeholder="Password" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <label for="CompanyName"></label><input type="text" class="form-control" id="CompanyName" name="CompanyName" placeholder="Company Name" value="NoCompany" />
                    </div>
                    <div class="modal-footer d-block">
                        <button type="submit" class="btn btn-warning float-end" name="submit">Sign Up!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</html>