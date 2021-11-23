<?php
include("function.php");
include("connect.php");
session_start();

// error_reporting(0);

$msg = ' ';
$email = ' ';
$msg1 = 'Log in';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $password = ($pass);

    // $salt = "codeflix";
    // $password_encrypted = sha1($pass.$salt);

    $checkbox = isset($_POST['remember']);
    // $profilepicture = $_FILES['profilepicture']['name'];
    // $firstname = $_POST['firstname'];
    // $checkbox = isset($_POST['remember']);
    // 
    if (email_exists($email, $conn)) {


        // $query = "SELECT * FROM register WHERE email='$email' AND pass='$password_encrypted'";
        // $result = mysqli_query($conn, $query);


        $result = mysqli_query($conn, "SELECT pass FROM register WHERE email='$email'");
        $retrievepassword = mysqli_fetch_assoc($result);

        $query = mysqli_query($conn, "SELECT count(*) as total FROM register WHERE email='$email'
        AND pass = '$password' ");
        $row = mysqli_fetch_array($query);

        if (md5($pass) == $retrievepassword['pass']) {
            $_SESSION['email'] = $email;

            if ($checkbox !== null) {
                setcookie('name', $email, time() + 9000);
            }
            header("location:editprofile.php");
            // echo "You are logged in";
        } else if (($row['total']) > 0) {
            $_SESSION['email'] = $email;

            if ($checkbox !== null) {
                setcookie('name', $email, time() + 9000);
            }
            header("location:editprofile.php");
            // echo "You are logged in";
        } else {
            $msg = "Incorrect Password";
            print_r("EMAIL in DB: " . $email);
            print_r("PASSWORD in DB: " . $retrievepassword['pass']);
            print_r("PASSWORD you Entered: " . $password);
        }

        $info = mysqli_query($conn, "SELECT firstname, lastname, profilepicture FROM register WHERE email='$email'");
        $retrieve = mysqli_fetch_array($info);

        $firstname = $retrieve['firstname'];
        $lastname = $retrieve['lastname'];
        $picture = $retrieve['profilepicture'];
        $profilepicture = "uploads/profilepictures" . $picture;

        $msg1 = "Welcome back" . $firstname . " " . $lastname;
    } else {
        $msg = "Incorrect Email";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />

    <title>Vee Gallery</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Fonts and Icons -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
</head>

<body>
    <div class="image-container set-full-height" style="background-image: url('')">


        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="green" id="wizardProfile">
                            <form method="POST" class="signin-form" id="signin-form">

                                <div class="wizard-header text-center">
                                    <div class="picture">
                                        <img src='<?php
                                                    if ($profilepicture == null) {
                                                        echo "assets/img/default-avatar.jpg";
                                                    } else {
                                                        echo $profilepicture;
                                                    }
                                                    ?>' class="picture-src" id="wizardPicturePreview" title="">
                                    </div>
                                    <h1 class="wizard-title"><?php echo $msg1; ?></h1>
                                    <h3 class="wizard-title">Log in your profile</h3>
                                    <p class="category">We are very happy to have you back.</p>
                                    <p class="category">
                                        <?php echo $msg; ?>
                                    </p>
                                </div>

                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#login" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-settings"></i>
                                                </div>
                                                Log in
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content" center>
                                    <!--ONLY PANE-->
                                    <div class="tab-pane" id="login">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">

                                                <div class="form-group">
                                                    <input name="email" type="email" class="form-control" placeholder="Email Address" value="<?php echo $email; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input name="pass" id="pass" type="password" class="form-control" placeholder="***********" required>
                                                    <a href>Forgotten Password?</a>
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" name="remember" id="remember" class="agree-term">

                                                    <label for="remember" class="label-agree-term">Remember me</label>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <!--fOOTER-->
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='submit' value="Log in" />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-sm-7 col-sm-offset-1">
                                    <div class="row">
                                        <h5>No account? <a href="register1.php">Sign up</a></h5>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- wizard container -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by V. Mkhabela 26978008
            </div>
        </div>
    </div>

</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="assets/js/demo.js" type="text/javascript"></script>
<script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>