<?php

include("function.php");
include("connect.php");
session_start();
error_reporting(0);


if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {

    $email = $_COOKIE['name'];

    if (isset($_POST['edit_metadata'])) {

        $userid = $_POST['userid'];
        $picture = $_FILES['picture']['name'];
        $tmp_picture = $_FILES['picture']['tmp_name'];
        $tag = $_POST['tag'];

        $targetPath = "./uploads/" . $tag . "/" . $picture;


        if ($picture == '') {
            echo "No Image uploaded";
        } else if (mysqli_query($conn, "INSERT INTO gallery (userid, picture, tag) VALUES ('$userid', '$picture', '$tag')")) {
            move_uploaded_file($tmp_picture, $targetPath);
            header("location:metadata.php");
        } else {
            echo "no connection & not moved";
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
        <link rel="stylesheet" href="css/maruti-style.css" />
        <link href="assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fonts and Icons -->
        <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
    </head>


    <body>

        <div id="user-nav" class="navbar">
            <ul class="navbar nav">
                <li>
                    <a class="btn" href="index.php"><i class="icon icon-user"></i>Home</a>
                </li>
                <li class="dropdown" id="menu-messages">
                    <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="btn"><i class="icon icon-envelope"></i>
                        About us
                        <ul class="dropdown-menu">
                            <li><a class="sAdd" title="" href="#">new message</a></li>
                            <li><a class="sInbox" title="" href="#">inbox</a></li>
                            <li><a class="sOutbox" title="" href="#">outbox</a></li>
                            <li><a class="sTrash" title="" href="#">trash</a></li>
                        </ul>
                </li>
                <li class="">
                    <a class="btn" title="" href="search.php"><i class="icon icon-cog"></i> Search</a>
                </li>
                <li class="">
                    <a class="btn" title="" href="logout.php"><i class="icon icon-share-alt"></i>
                        Logout</a>
                </li>
            </ul>
        </div>




        <!--div class="image-container set-full-height" style="background-image: url('assets/img/paper-1.jpeg')"-->


        <div class="container">

            <?php
            if (isset($_POST['upload_user'])) {
                $_id = $_POST['upload_id'];

                $query = mysqli_query($conn, "SELECT * FROM register WHERE id = '$_id'");
                $retrieve = mysqli_fetch_array($query);

                $firstname = $retrieve['firstname'];
                $lastname = $retrieve['lastname'];


            ?>









                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <!--      Wizard container        -->
                        <div class="wizard-container">
                            <div class="wizard-card" data-color="green" id="wizardProfile">
                                <form action=" " method="POST" enctype="multipart/form-data">

                                    <div class="wizard-header text-center">
                                        <h1 class="wizard-title">Picture Wizard-Card</h1>
                                        <h3 class="wizard-title">What would you like to upload?</h3>
                                        <p class="category">Acceptable format: jpg, png, jpeg, raw</p>
                                    </div>

                                    <div class="wizard-navigation">
                                        <div class="progress-with-circle">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="#upload" data-toggle="tab">
                                                    <div class="icon-circle">
                                                        <i class="ti-user"></i>
                                                    </div>
                                                    Upload
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">

                                        <!--FIRST PANE-->
                                        <div class="tab-pane" id="upload">
                                            <div class="row">
                                                <h4 class="info-text"> Please upload image.</h4>

                                                <div class="col-sm-4 col-sm-offset-4">
                                                    <div class="picture-container" center>
                                                        <div class="picture">
                                                            <img src="assets/img/default-avatar.jpg" class="picture-src" id="wizardPicturePreview" title="" />
                                                            <!--PROFILE PICTURE-->
                                                            <input type="file" name="picture" id="wizard-picture" accept=".jpg, .png,">
                                                        </div>
                                                        <h6>Choose Picture</h6>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="col-sm-5 col-sm-offset-1">
                                                    <div class="form-group">
                                                        <label>Image privacy:</label><br>
                                                        <select name="tag" class="form-control">
                                                            <option value="timeline">Timeline</option>
                                                            <option value="private">Private</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Share with:</label><br>
                                                        <input name="share" type="text" class="form-control" value="<?php echo ucfirst($retrieve['firstname'])." ".ucfirst($retrieve['lastname']) ; ?>" placeholder="Mark Lious">
                                                        <input name="userid" type="hidden" class="form-control" value="<?php echo "$_id"; ?>" placeholder="Mark Lious">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--fOOTER-->
                                    <div class="wizard-footer col-sm-10 col-sm-offset-2">
                                        <div class="pull-right">
                                            <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='edit_metadata' value='Upload' />
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- wizard container -->
                    </div>
                </div>

            <?php

            } else { 
                
                $query = mysqli_query($conn, "SELECT * FROM register WHERE email = '$email'");
                $retrieve = mysqli_fetch_array($query);

                $_id = $retrieve['id'];
                
                ?>

            


                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <!--      Wizard container        -->
                        <div class="wizard-container">
                            <div class="wizard-card" data-color="green" id="wizardProfile">
                                <form action=" " method="POST" enctype="multipart/form-data">

                                    <div class="wizard-header text-center">
                                        <h1 class="wizard-title">Picture Wizard-Card</h1>
                                        <h3 class="wizard-title">What would you like to upload?</h3>
                                        <p class="category">Acceptable format: jpg, png, jpeg, raw</p>
                                    </div>

                                    <div class="wizard-navigation">
                                        <div class="progress-with-circle">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="#upload" data-toggle="tab">
                                                    <div class="icon-circle">
                                                        <i class="ti-user"></i>
                                                    </div>
                                                    Upload
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">

                                        <!--FIRST PANE-->
                                        <div class="tab-pane" id="upload">
                                            <div class="row">
                                                <h4 class="info-text"> Please upload image.</h4>

                                                <div class="col-sm-4 col-sm-offset-4">
                                                    <div class="picture-container" center>
                                                        <div class="picture">
                                                            <img src="assets/img/default-avatar.jpg" class="picture-src" id="wizardPicturePreview" title="" />
                                                            <!--PROFILE PICTURE-->
                                                            <input type="file" name="picture" id="wizard-picture" accept=".jpg, .png,">
                                                        </div>
                                                        <h6>Choose Picture</h6>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="col-sm-5 col-sm-offset-1">
                                                    <div class="form-group">
                                                        <label>Image privacy:</label><br>
                                                        <select name="tag" class="form-control">
                                                            <option value="timeline">Timeline</option>
                                                            <option value="private">Private</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--fOOTER-->
                                    <div class="wizard-footer col-sm-10 col-sm-offset-2">
                                        <div class="pull-right">
                                            <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='edit_metadata' value='Upload' />
                                            <input name="userid" type="hidden" class="form-control" value="<?php echo "$_id"; ?>" placeholder="Mark Lious">
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- wizard container -->
                    </div>
                </div>



            <?php }

            ?>
            <!-- end row -->
        </div>


        <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by <a href="https://www.creative-tim.com">Creative Tim</a>. Free download <a href="https://www.creative-tim.com/product/paper-bootstrap-wizard">here.</a>
            </div>
        </div>
        </div>
        
        <script>
      function seconds() {
        setTimeout(function() {
          window.location.href = "http://localhost/Project%202/Project--master/26978008_Proj2/googledrive.php";
        }, 5000);
      }
    </script>

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
<?php

}

?>