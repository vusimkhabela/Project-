<?php

include("function.php");
include("connect.php");
session_start();


if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {

    $email = $_COOKIE['name'];
    $title = ' ';
    $picturetype = ' ';
    $picturesize = ' ';
    $info = mysqli_query($conn, "SELECT title, picture, metadata, tag FROM gallery");
    $retrieve = mysqli_fetch_array($info);

    $title = $retrieve['title'];
    $picture = $retrieve['picture'];
    $metadata = $retrieve['metada'];
    $tag = $retrieve['tag'];
    

    if (isset($_POST['submit'])) {
        print_r($retrieve);


        $title = $_POST['title'];
        $picture = $_FILES['picture']['name'];
        // $picturesize = $_FILES['picture']['size'];
        // $picturetype = $_FILES['picture']['type'];
        $tmp_picture = $_FILES['picture']['tmp_name'];
        $movetargetPath = "./uploads/" .$tag;
        $gettargetPath = "./uploads/".$tag."/";

        $metadata = $_POST['album'];
        $tag = $_POST['tag'];

        move_uploaded_file($tmp_picture, $movetargetPath);
        echo "Image Edited successfully";
            mysqli_query($conn, "INSERT INTO gallery(title, picture, metadata, tag)
            VALUES ('$title', '$picture', '$metadata', '$tag')");
            header("location:metadata.php");
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

        <!-- Fonts and Icons -->
        <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
    </head>


    <body>

        <div class="navbar">
            <div class="navbar-nav">
                <a class="btn" href="#">Home</a>
                <a class="btn" href="#">Search</a>
                <a class="btn" href="#">Profile</a>
                <a class="btn" href="#">About us</a>
                <a class="btn" href="#">Contact</a>
            </div>
        </div>




        <!--div class="image-container set-full-height" style="background-image: url('assets/img/paper-1.jpeg')"-->


        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="wizard-card" data-color="orange" id="wizardProfile">
                        <form action=" " method="POST" enctype="multipart/form-data">

                                <div class="wizard-header text-center">
                                    <h1 class="wizard-title">Picture Wizard</h1>
                                    <h3 class="wizard-title">Image Metadata Management</h3>
                                    <p class="category">Please edit the information below</p>
                                </div>

                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#preview" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-settings"></i>
                                                </div>
                                                Preview Image
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#finish" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-map"></i>
                                                </div>
                                                Edit Metadata
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">

                                    <!--SECOND PANE-->
                                    <div class="tab-pane" id="preview">
                                        <div class="row">
                                            <div class="picture">
                                                    <img src="./uploads/<?php $tag; ?>/<?php $picture; ?>" style='width: 350px;' class='img-fluid img-thumbnail' title=""/>
                                                <!--PROFILE PICTURE-->
                                            </div>
                                        </div>
                                    </div>



                                    <!--THIRD PANE-->
                                    <div class="tab-pane" id="finish">
                                        <div class="row">
                                            <h4 class="info-text">Image Metadata</h4>
                                            <!--IMAGE DETAILS-->
                                            <div class="info-text">
                                                <label>Size <small><?php echo $picturesize ;?></small></label>
                                                <label>Format: <small><?php echo $picturetype ;?></small></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Title: <small>(required)</small></label>
                                                    <input name="title" type="text" class="form-control" value ="<?php echo $picture;?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Authors:</label>
                                                    <input name="authors" type="text" class="form-control" placeholder="Mark Mkhabela, Luke Knowles">
                                                </div>
                                                <div class="form-group">
                                                    <label>Date taken:</label>
                                                    <input name="date" type="datetime-local" class="form-control" placeholder="26978008@nwu.ac.za">
                                                </div>
                                                <div class="form-group">
                                                    <label>Location:</label>
                                                    <input name="location" type="text" class="form-control" placeholder="26978008@nwu.ac.za">
                                                </div>
                                                <div class="form-group">
                                                    <label>Device used:</label>
                                                    <input name="device" type="text" class="form-control" placeholder="26978008@nwu.ac.za">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tags: <small>(optinal)</small></label>
                                                    <input name="tags" type="text" class="form-control" placeholder="Holiday, Trip, Vacation, Clouds">
                                                </div>
                                            </div>
                                            <h4 class="info-text">Image Groupshare</h4>
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label>Image album:</label><br>
                                                    <select name="album" class="form-control">
                                                        <option value="solo"> Solo </option>
                                                        <option value="travel"> Travel </option>
                                                        <option value=" "> Fashion </option>
                                                        <option value="family"> Family </option>
                                                    </select>
                                                    <label>Image privacy:</label><br>
                                                    <select name="tag" class="form-control">
                                                        <option value="public">Timeline</option>
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
                                        <input type='next' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                        <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='submit' value='Done' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <!-- <?php

                                    $sql = "SELECT picture FROM gallery";
                                    $retrieve = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($retrieve) > 0) {
                                        while ($fetch = mysqli_fetch_assoc($retrieve)) {
                                    ?>
                            <img src= "./uploads/profilepictures/
                            <?php $fetch['$picture'];
                            ?>"
                            width = 100 height=100>
                        <?php
                                        }
                                    }

                        ?> -->
                        </div>
                    </div>
                    <!-- wizard container -->
                </div>
            </div>
            <!-- end row -->
        </div>


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
<?php

}

?>