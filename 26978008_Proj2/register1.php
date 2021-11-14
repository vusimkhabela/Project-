<?php
include("function.php");
include("connect.php");
$msg2 = ' ';
$msg1 = ' ';
$msg = ' ';
$msg3 = ' ';
$msg4 = ' ';
$firstname = ' ';
$lastname = ' ';
$email = ' ';
$num = ' ';
$password = ' ';
$tagline = ' ';
$profilepicture = ' ';
$checkbox = ' ';
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $radio = isset($_POST['gender']);
    $email = $_POST['email'];
    $num = $_POST['num'];
    $country = $_POST['country'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];
    $checkbox1 = isset($_POST['hobby']);
    $profilepicture = $_FILES['profilepicture']['name'];
    $tmp_profilepicture = $_FILES['profilepicture']['tmp_name'];
    $pp = "./uploads/profilepictures" .$picture;
    $checkbox = isset($_POST['terms']);
    $tagline = $_POST['tagline'];
    echo "Saved user:" . $firstname . " " . $lastname . " , " . $radio . " , " . $country . " , " . $checkbox
        . " , " . $email . " , " . $num . " , " . $password . " , " . $profilepicture . " , " . $checkbox1 . " " . $tagline;
    if (strlen($password) < 6) {
        $msg = "Your membership was not saved! Password must contain 5 characters";
    } else if ($password !== $cpassword) {
        $msg1 = "Your membership was not saved! Password is not the same.";
    } else if (email_exists($email, $conn)) {
        $msg4 = "Your membership was not saved! The email already exists.";
        $msg2 = ' ';
        $msg1 = ' ';
        $msg = ' ';
        $msg3 = ' ';
        $firstname = ' ';
        $lastname = ' ';
        $email = ' ';
        $num = ' ';
    } else if ($checkbox == '') {
        $msg2 = "Your membership was not saved! Please Agree with our Terms and Conditions";
    } else if (strlen($password) < 6) {
        $msg = "Your membership not saved! Password must contain 5 characters";
    } else if ($password !== $cpassword) {
        $msg1 = "Your membership not saved! Password is not the same.";
    } else {
        move_uploaded_file($tmp_profilepicture, $pp);
        // $password = md5($password);
        // password encryption
        mysqli_query($conn, "INSERT INTO register(firstname, lastname, gender, country, terms, email, num, pass, profilepicture, hobby, tagline)
        VALUES ('$firstname', '$lastname', '$radio', '$country', '$checkbox', '$email', '$num', '$password', '$profilepicture', '$checkbox1', '$tagline')");
        $msg3 = "Your membership was successfully saved!";
        $msg2 = ' ';
        $msg1 = ' ';
        $msg = ' ';
        $firstname = ' ';
        $lastname = ' ';
        $email = ' ';
        $num = ' ';
        $tagline = ' ';
        $profilepicture = ' ';
    }
}
if (isset($_POST['next'])) {
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


    <link rel="apple-touch-icon" sizes="76x76" href="" />
    <!--small icon on window tabe-->
    <link rel="icon" type="image/png" href="" />

    <title>Vee Gallery</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

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
                        <div class="card wizard-card" data-color="orange" id="wizardProfile">
                            <form action=" " method="POST" enctype="multipart/form-data">

                                <div class="wizard-header text-center">
                                    <h1 class="wizard-title">Welcome</h1>
                                    <h3 class="wizard-title">Create your profile</h3>
                                    <p class="category">This information will let us know more about you.</p>
                                    <p class="category">
                                        <?php echo $msg; ?>
                                        <?php echo $msg1; ?>
                                        <?php echo $msg2; ?>
                                        <?php echo $msg3; ?>
                                        <?php echo $msg4;
                                        echo $msg3 = '';
                                        echo $msg2 = '';
                                        echo $msg1 = '';
                                        echo $msg0 = '';   ?>
                                    </p>
                                </div>

                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#about" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-user"></i>
                                                </div>
                                                About
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#password" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-settings"></i>
                                                </div>
                                                Password
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#account" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-map"></i>
                                                </div>
                                                Profile
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">

                                    <!--FIRST PANE-->
                                    <div class="tab-pane" id="about">
                                        <div class="row">
                                            <h5 class="info-text"> Please tell us more about yourself.</h5>
                                            <div class="col-sm-4 col-sm-offset-1">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        <img src="assets/img/default-avatar.jpg" class="picture-src" id="wizardPicturePreview" title="" />
                                                        <!-- PROFILE PICTURE change accept formats -->
                                                        <input type="file" name="profilepicture" id="wizard-picture" value='<?php echo $profilepicture; ?>' accept=".jpg, .png,">
                                                    </div>
                                                    <h6>Choose Picture</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="firstname">First Name <small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control" placeholder="Vusi..." value='<?php echo $firstname; ?>'>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastname">Last Name <small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control" placeholder="Mkhabela..." value='<?php echo $lastname; ?>'>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <div>
                                                        <label for="male" class="radio-inline"><input type="radio" name="gender" value="m" id="male" />Male</label>
                                                        <label for="female" class="radio-inline"><input type="radio" name="gender" value="f" id="female" />Female</label>
                                                        <label for="others" class="radio-inline"><input type="radio" name="gender" value="o" id="others" />Others</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label for="email">Email <small>(required)</small></label>
                                                    <input name="email" type="email" class="form-control" placeholder="26978008@nwu.ac.za" value='<?php echo $email; ?>'>
                                                </div>
                                                <div class="form-group">
                                                    <label for="num">Contacts</label>
                                                    <input name="num" type="number" class="form-control" id="tel" placeholder="+27767531710" value='<?php echo $number; ?>' digits>
                                                </div>
                                            </div>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label>Country</label><br>
                                                    <select name="country" class="form-control" placeholder='<?php echo $firstname; ?>'>
                                                        <option value="Afghanistan"> Afghanistan </option>
                                                        <option value="Albania"> Albania </option>
                                                        <option value="Algeria"> Algeria </option>
                                                        <option value="American Samoa"> American Samoa </option>
                                                        <option value="Andorra"> Andorra </option>
                                                        <option value="Angola"> Angola </option>
                                                        <option value="Anguilla"> Anguilla </option>
                                                        <option value="Antarctica"> Antarctica </option>
                                                        <option value="...">...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--SECOND PANE-->
                                    <div class="tab-pane" id="password">
                                        <div class="row">
                                            <div class="col-sm-7 col-sm-offset-3">
                                                <h5 class="info-text"> Create a password </h5>

                                                <div class="form-group">
                                                    <input type="password" id="pass" name="pass" class="form-control" placeholder="**********" required>
                                                    <div class="password-policies">
                                                        <div class="length">
                                                            8 Characters
                                                        </div>
                                                        <div class="number">
                                                            Contains Number
                                                        </div>
                                                        <div class="uppercase">
                                                            Contains Uppercase
                                                        </div>
                                                        <div class="special">
                                                            Contains Special Characters
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>
                                                <h6 class="info-text"> Repeat password </h6>
                                                <div class="form-group">
                                                    <input type="password" name="cpass" class="form-control" placeholder="**********" required>
                                                </div>

                                                <hr />
                                                <div class="form-group">
                                                    <input type="checkbox" name="terms" id="terms" class="agree-term" required>

                                                    <label for="terms" class="label-agree-term">Please read and Agree with our <a href>
                                                            terms and conditions.</a></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <!--THIRD PANE-->
                                    <div class="tab-pane" id="account">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                    <h5 class="info-text"> What tags best suit you (your interests)?</h5>
                                                    <input name="tagline" type="text" class="form-control" value='<?php echo $tagline; ?>'>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="info-text"> What are you Hobbies? (checkboxes) </h5>
                                        <!--HOBBIES LIST-->
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Graphic Design">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-paint-roller"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Fishing">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <<i class="fas fa-fish"></i>>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby4" value="Photography">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="fab fa-algolia"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Gym">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="fas fa-dumbbell"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Football">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="fas fa-football-ball"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Travel">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <<i class="fas fa-passport"></i>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Cooking">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="fas fa-blender"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Reading">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="fas fa-book-reader"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Gardening">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <<i class="fas fa-seedling"></i>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Singing">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <<i class="fas fa-music"></i>></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Playing Instruments">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <<i class="fas fa-guitar"></i>></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Writing">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- NEEDS TO BE THE SAME AS THE HOBBIES ABOVE
                                            <div class="col-sm-8 col-sm-offset-2">
		                                        <div class="col-sm-4 col-sm-offset-2">
													<div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="jobb" value="Design">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-home"></i>
															<p>Home</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
													<div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="jobb" value="Design">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-package"></i>
															<p>Apartment</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div> -->
                                        </div>
                                    </div>

                                </div>


                                <!--fOOTER-->
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='next' id='next' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                        <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='submit' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-sm-7 col-sm-offset-1">
                                    <div class="row">
                                        <h5>Already registered ? <a href="login.php">Log in</a></h5>
                                        Tersms of popnsdjcbsghdv shdvchsjdb vhsdv askhdcbhas ck h ashc sj ijasbc sdchva scahs cabscg ascagsvcha scka ashjbcahjdvcbksbcjksbd vkbsdklvnsljvn;k
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
                Made with <i class="fa fa-heart heart"></i> by <a href="https://www.creative-tim.com">Creative Tim</a>. Free download <a href="https://www.creative-tim.com/product/paper-bootstrap-wizard">here.</a>
            </div>
        </div>
    </div>



</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript"></script>
<!--  Plugin for the Wizard -->
<script src="assets/js/demo.js" type="text/javascript"></script>
<script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>