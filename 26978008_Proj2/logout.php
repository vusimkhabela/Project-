<?php
include("function.php");
include("connect.php");

session_start();
session_destroy();
setcookie('name', '', time() - 9000);


// $email = $_SESSION['email'];
// $info = mysqli_query($conn, "SELECT firstname, lastname, gender, num, country, profilepicture, hobby, tagline FROM register WHERE email='$email'");
// $retrieve = mysqli_fetch_array($info);
// // print_r($retrieve);
// $firstname = $retrieve['firstname'];
// $lastname = $retrieve['lastname'];
// $radio = isset($retrieve['gender']);
// $num = $retrieve['num'];
// $country = $retrieve['country'];
// $profilepicture = $retrieve['profilepicture'];
// $checkbox1 = isset($retrieve['hobby']);
// $tagline = $retrieve['tagline'];

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
    <link rel="stylesheet" href="css/maruti-style.css" />
    <link href="assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

    <!-- Fonts and Icons -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
</head>


<body>

    <div class="navbar">
        <div class="navbar-nav">
            <a class="btn" href="#">About us</a>
            <a class="btn" href="login.php">Sign in</a>
        </div>
    </div>




    <!--div class="image-container set-full-height" style="background-image: url('assets/img/paper-1.jpeg')"-->


    <!--   Big container   -->
    <div class="container">
        <div class="col-dm-7 col-sm-offset-1">
            <!--      Wizard container        -->

            <div class="wizard-header text-center">
                <h1 class="wizard-title">Vee Gallery</h1>
                <h3 class="wizard-title">Number 1 Photo sharing and Metadata Management Cloud-Based application</h3>
                <p class="category">View & Share your memories with the community.</p>
            </div>

            <hr />

            <div class="pics-container">

                <div class="photo-gallery">
                    <div class="pic molo">
                        <a href="#" class="item">
                            <img src="paper-1.jpeg">
                        </a>
                    </div>
                    <div class="pic family">
                        <a href="#" class="item">
                            <img src="assets/img/wizard-list-place.png">
                        </a>
                    </div>
                    <div class="pic travels">
                        <a href="#" class="item">
                            <img src="assets/img/wizard-create-profile.png">
                        </a>
                    </div>


                </div>
            </div>
            <hr />
            <!--fOOTER-->
            <div class="col-sm-7 col-sm-offset-1">
                <div class="row">
                    <h5>No account? <a href>Sign up</a></h5>
                    Tersms of popnsdjcbsghdv shdvchsjdb vhsdv askhdcbhas ck h ashc sj ijasbc sdchva scahs cabscg ascagsvcha scka ashjbcahjdvcbksbcjksbd vkbsdklvnsljvn;ksdmvccz

                </div>
            </div>

            </form>
        </div>
        <!-- wizard container -->


    </div>
    </div>
    <!-- end row -->
    </div>
    <!--  big container -->



    <div class="footer">
        <div class="container text-center">
            Made with <i class="fa fa-heart heart"></i> by <a href="https://www.creative-tim.com">Creative Tim</a>. Free download <a href="https://www.creative-tim.com/product/paper-bootstrap-wizard">here.</a>
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