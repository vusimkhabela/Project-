<?php

include("function.php");
include("connect.php");
session_start();



if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {


    $email = $_COOKIE['name'];

    $title = ' ';

    $user = mysqli_query($conn, "SELECT id, firstname, lastname FROM register
    ORDER BY id DESC LIMIT 1");
    $retrieveuser = mysqli_fetch_array($user);
    $userid = $retrieveuser['id'];
    $u_id = $userid;
    $firstname = $retrieveuser['firstname'];
    $lastname = $retrieveuser['lastname'];

    $metadata = mysqli_query($conn, "SELECT * FROM metadata_management");
    $retriever = mysqli_fetch_array($metadata);
    if (isset($_POST['edit_metadata'])) {
        $_id = $_POST['edit_id'];


{    $info = mysqli_query($conn, "SELECT * FROM gallery
    ORDER BY id");
    $retrieve = mysqli_fetch_array($info);
    $gallery_id = $retrieve['id'];
    $g_id = $gallery_id;
    $picture = $retrieve['picture'];
    $title = $retrieve['title'];

    $taginfo = $retrieve['tag'];

    $pictureuploaded = "./uploads/" . $taginfo . "/" . $picture;
    $exif_data = exif_read_data($pictureuploaded);

    $fileSize = $exif_data['FileSize'];
    $MimeType =  $exif_data['MimeType'];

    $model = $exif_data['Model'];
    // $dateTimeOriginal = $exif_data['DateTimeOriginal'];
    // // // $dateTimeOriginal=  date('Y/m/s h:i', $dateTimeOriginal);
    // // // print_r($dateTimeOriginal);
    // // $software = $exif_data['Software'];

    $exposureTime = $exif_data['ExposureTime'];
    $isoSpeedRatings = $exif_data['ISOSpeedRatings'];
    $focalLength = $exif_data['FocalLength'];


    if (isset($_POST['submit'])) {

        // print_r($retrieve);
        // $size = $_FILES[$pictureuploaded]['size'];
        // $format = $_FILES[$pictureuploaded]['format'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $uploaded = $_POST['uploaded'];
        // $uploaded = $_POST['uploaded'];
        $plocation = $_POST['plocation'];
        $device = $_POST['device'];
        $tag = $_POST['tag'];
        $album = $_POST['album'];

        // mysqli_query($conn, "INSERT INTO meta(picture, title, author, taken,
        //     plocation, device, tag, album, privacy)
        //     VALUES ('$upicture', '$title', '$author', '$taken', 
        //     '$plocation', '$device', '$tag', '$album','$privacy')");
        //     // VALUES ('$picture', '$size', '$format', '$title', '$author', '$taken', '$uploaded ', 
        //     // '$plocation', '$device', '$tag', '$album','$privacy')");

        if ($picture == '') {
            echo "No Image was ever saved";
        } else if (mysqli_query($conn, "INSERT INTO metadata_management
        (picture, title, author, uploaded, plocation, device, tag, album, privacy, userid, 
        galleryid, fileSize, MimeType, exposureTime, isoSpeedRatings, focalLength) 
        VALUES ('$picture','$title', '$author', '$uploaded','$plocation', '$device', '$tag', '$album','$taginfo', '$u_id', '$g_id',
        '$fileSize', '$MimeType', '$exposureTime', '$isoSpeedRatings', '$focalLength')")) {

                header("location:index.php");
        }
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
                            <?php

                                $query = "SELECT * FROM metadata_management WHERE galleryid = '$_id'";
                                $query_run = mysqli_query($conn, $query);

                                foreach ($query_run as $row) {
                                    if ($pictureuploaded = "./uploads/" . $row['privacy'] . "/" . $row['picture']) {
                                        echo "Success Loading image!";
                                        print_r("EDIT ID: " . $_id);
                                        print_r("GALLERY ID: " . $row['galleryid']);
                                        print_r($pictureuploaded);
                                    } else {
                                        echo "Failed loading Imaged";
                                        print_r("EDIT ID: " . $_id);
                                        print_r("GALLERY ID: " . $row['galleryid']);
                                    }
                            ?>


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
                                                    <div class="uploadedpicture">
                                                        <?php
                                                        echo "<div name = 'picture'>";
                                                        echo "<img src=./uploads/" . $row['privacy'] . "/" . $row['picture'] . ">";
                                                        echo "</div>"
                                                        ?>

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
                                                        <label>Size <small><?php echo $fileSize; ?> kb </small></label>
                                                        <label>Format: <small><?php echo $MimeType; ?></small></label>
                                                    </div>
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <div class="form-group">
                                                            <label>Picture Title: <small>(required)</small></label>
                                                            <input name="title" type="text" class="form-control" value="<?php echo $row['title']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Authors:</label>
                                                            <input name="author" type="text" class="form-control" value="<?php echo $row['author'] . " "; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date Modified:</label>
                                                            <input name="uploaded" type="datetime-local" class="form-control" value="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Location:</label>
                                                            <input name="plocation" type="text" class="form-control" value="<?php echo $row['plocation']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Device used:</label>
                                                            <input name="device" type="text" class="form-control" value="<?php echo $row['model']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tags: <small>(optinal)</small></label>
                                                            <input name="tag" type="text" class="form-control" value="<?php echo $row['tag']; ?>" placeholder="Holiday, Trip, Vacation, Clouds">
                                                        </div>
                                                    </div>
                                                    <h5 class="info-text">Optional Information</h5>
                                                    <div class="col-sm-5 col-sm-offset-3">
                                                        <div class="form-group">
                                                            <label>Image album:</label><br>
                                                            <select name="album" class="form-control">
                                                                <option value="solo"> Solo </option>
                                                                <option value="travel"> Travel </option>
                                                                <option value="fashion"> Fashion </option>
                                                                <option value="family"> Family </option>
                                                            </select>
                                                            <label for="software">Software used:</label>
                                                            <input name="software" type="text" class="form-control" value="<?php echo $row['software']; ?>">
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

                            <?php

                                }
                            }

                            ?>

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