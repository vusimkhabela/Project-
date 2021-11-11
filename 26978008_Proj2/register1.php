<?php

include("connect.php");
$msg2=' ';
$msg1=' ';
$msg=' ';
$msg3=' ';
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $radio= isset($_POST['gender']);
    $email = $_POST['email'];
    $num = $_POST['num'];
    $country = $_POST['country'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $checkbox = isset($_POST['hobby']);
    $profilepicture = $_FILES['profilepicture']['name'];
    $tmp_profilepicture = $_FILES['profilepicture']['tmp_name'];
    $checkbox = isset($_POST['terms']);
    echo "Saved user:" .$firstname. " " .$lastname. " , " .$radio. " , " .$country. " , " .$checkbox;
    if (strlen($pass) < 6) {
        $msg = "Your membership was not saved! Password must contain 5 characters";
    } else if ($pass !== $cpass) {
        $msg1 = "Your membership was not saved! Password is not the same.";
    } else if ($checkbox==1) {
        $msg2 = "Your membership was not saved! Please Agree with our Terms and Conditions";
    }
    else{
        mysqli_query($conn, "INSERT INTO register(firstname, lastname, gender, email, num, country, pass, hobby, profilepicture, terms)
        VALUES ('$firstname', '$lastname', '$gender', '$email', '$num', '$country', '$pass', '$hobby', '$profilepicture', '$terms')");
        $msg3 = "Your membership was successfully saved!";
    }
}
if (isset($_POST['next'])) {
    if (strlen($pass) < 6) {
        $msg = "Your membership not saved! Password must contain 5 characters";
    } else if ($pass !== $cpass) {
        $msg1 = "Your membership not saved! Password is not the same.";
    } else if ($checkbox !== 'on') {
        $msg2 = "Your membership not saved! Please Agree with our Terms and Conditions.";
    }
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
                                                        <!--PROFILE PICTURE-->
                                                        <input type="file" name="profilepicture" id="wizard-picture">
                                                    </div>
                                                    <h6>Choose Picture</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>First Name <small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control" placeholder="Vusi...">
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name <small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control" placeholder="Mkhabela...">
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
                                                    <label>Email <small>(required)</small></label>
                                                    <input name="email" type="email" class="form-control" placeholder="26978008@nwu.ac.za">
                                                </div>
                                                <div class="form-group">
                                                    <label>Contacts</label>
                                                    <input name="num" type="number" class="form-control" placeholder="+27767531710">
                                                </div>
                                            </div>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label>Country</label><br>
                                                    <select name="country" class="form-control">
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
                                                    <input type="password" name="pass" class="form-control" placeholder="**********"> Password with at least 6 or more characters.
                                                </div>
                                                <h6 class="info-text"> Repeat password </h6>
                                                <div class="form-group">
                                                    <input type="password" name="cpass" class="form-control" placeholder="**********">
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="terms" id="terms" class="agree-term" />
                                                    <label for="terms" class="label-agree-term"><span><span></span></span>Agree with
                                                        the terms and conditions.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!--THIRD PANE-->
                                    <div class="tab-pane" id="account">
                                        <h5 class="info-text"> What are you Hobbies? (checkboxes) </h5>
                                        <!--HOBBIES LIST-->
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Design">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-paint-roller"></i>
                                                            <p>Design</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Code">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-pencil-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby4" value="Develop">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-star"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Design">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-paint-roller"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Code">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-pencil-alt"></i>
                                                            <p>Code</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Develop">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-star"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Design">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-paint-roller"></i>
                                                            <p>Design</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Code">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-pencil-alt"></i>
                                                            <p>Code</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Develop">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-star"></i>
                                                            <p>Develop</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Design">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-paint-roller"></i>
                                                            <p>Design</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Code">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-pencil-alt"></i>
                                                            <p>Code</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-checkbox">
                                                        <input type="checkbox" name="hobby" value="Develop">
                                                        <div class="card card-checkboxes card-hover-effect">
                                                            <i class="ti-star"></i>
                                                            <p>Develop</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <!--fOOTER-->
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='next' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                        <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='submit' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-sm-7 col-sm-offset-1">
                                    <div class="row">
                                        <h5>Already a member? <a href>Log in</a></h5>
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

<!--  Plugin for the Wizard -->
<script src="assets/js/demo.js" type="text/javascript"></script>
<script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>