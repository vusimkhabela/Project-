<?php

include("function.php");
include("connect.php");
session_start();



if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {


    $email = $_COOKIE['name'];

    $info = mysqli_query($conn, "SELECT id, firstname, lastname, gender, num, country, profilepicture, hobby, tagline FROM register WHERE email='$email'");
    $retrieve = mysqli_fetch_array($info);

    if ($retrieve != null) {
        $firstname = $retrieve['firstname'];
        $lastname = $retrieve['lastname'];
        $radio = isset($retrieve['gender']);
        $num = $retrieve['num'];
        $country = $retrieve['country'];
        $profilepicture = $retrieve['profilepicture'];
        $checkbox1 = isset($retrieve['hobby']);
        $tagline = $retrieve['tagline'];
    } else {
        //     $result_id = visited person's profile id
        //     $info2 = mysqli_query($conn, "SELECT id, firstname, lastname, gender, num, country, profilepicture, hobby, tagline FROM register WHERE id='$email'");
        // $retrieve2 = mysqli_fetch_array($info2);
    }

    $userID = $retrieve['id'];

    $display = mysqli_query($conn, "SELECT * FROM metadata_management WHERE userid = '$userID'");
    $retriever = mysqli_fetch_array($display);

    if ($retriever != null) {
        $gallery_id = $retriever['galleryid'];
        // $g_id = $gallery_id;
        $picture = $retriever['picture'];
        $title = $retriever['title'];
        $privacy = $retriever['privacy'];
        // $metadata = $retrieve['metadata'];

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

        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="dropdown" id="menu-messages">
                    <a href="index.php" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="text" class="btn">Home</span>
                        <ul class="dropdown-menu">
                            <li><a href="editprofile.php" class="btn" title="" href="#">MyPersonalSpace!</a></li>
                        </ul>
                </li>
                <li>
                    <a class="btn" href="search.html">Search</a>
                </li>
                <li class="dropdown" id="menu-messages">
                    <a href="editprofile.php" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="text">Profile</span>
                        <ul class="dropdown-menu">
                            <li><a class="btn" title="" href="editprofile.php">Edit Profile</a></li>
                            <li><a class="btn" title="" href="upload.html">Upload</a></li>
                            <li><a class="btn" title="" href="#">Metadata Management</a></li>
                        </ul>
                </li>
                <li>
                    <a class="btn" href="#">Contact</a>
                </li>
                <li>
                    <a class="btn" href="logout.php">Log out</a>
                </li>
            </ul>
        </nav>

        <div class="wizard-content" data-color="orange">
            <div class="wizard-header text-center">
                <h1 class="wizard-title">Personal Space</h1>
                <h3 class="wizard-title">What would you like to upload?</h3>
                <p class="category">Acceptable format: jpg, png, jpeg, raw</p>

                <p class="category">
                    <?php echo $email; ?>
                </p>

            </div>
        </div>

        <div class="container">

            <div class="col-sm-3">
                <hr />
                <div class="widget-box">
                    <header>
                        <div class="user">
                            <img src='<?php
                                        if ($profilepicture == null) {
                                            echo "assets/img/default-avatar.jpg";
                                        } else {
                                            echo "uploads/profilepictures/" . $profilepicture;
                                        } ?>' alt="Profile Picture">
                            <h3 class="name"><?php echo ucfirst($firstname) . " " . ucfirst($lastname); ?></h3>
                            <p class="post"><?php echo $tagline; ?></p>
                        </div>

                        <nav class="navbar-user">
                            <ul>
                                <li><a href="#bio">About</a></li>
                                <li><a href="#picturesuploaded">Pictures</a></li>
                                <li><a href="#education">Albums</a></li>
                                <li><a href="#chats">Chats</a></li>
                            </ul>
                        </nav>

                        <nav class="navbar">
                            <li class="btn"><a href="#bio">Facebook</a></li>
                            <li class="btn"><a href="#picturesuploaded">Twitter</a></li>
                            <li class="btn"><a href="#education">Instagram</a></li>
                            <li class="btn"><a href="#chats">Google+</a></li>
                        </nav>
                    </header>
                </div>
                <hr />

                <div class="col-sm-7">
                    <div class="row">
                        <h5>No account? <a href>Sign up</a></h5>
                        Tersms of popnsdjcbsghdv shdvchsjdb vhsdv askhdcbhas ck h ashc sj ijasbc sdchva scahs cabscg ascagsvcha scka ashjbcahjdvcbksbcjksbd vkbsdklvnsljvn;ksdmvccz

                    </div>
                </div>
            </div>

            <div class=" " data-color=" " id=" ">
                        <?php
                        if (isset($_POST['edit_metadata'])) {
                            $_id = $_POST['edit_id'];

                            $query = "SELECT * FROM metadata_management WHERE galleryid = '$_id'";
                            $query_run = mysqli_query($conn, $query);

                            foreach ($query_run as $row) {
                                if ($pictureuploaded = "./uploads/" . $row['privacy'] . "/" . $row['picture']) {
                                    echo "Success Loading image!";
                                    print_r("EDIT ID: " . $_id);
                                    print_r("GALLERY ID: " . $row['galleryid']);
                                    print_r($pictureuploaded);
                                    print_r($row['picture']);
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



                                        <!--SECOND PANE-->
                                        <div class="img-thumbnal">
                                            <div class="row">
                                                <div class="uploadedpicture">
                                                    <!-- <?php
                                                            echo "<div name = 'picture'>";
                                                            echo "<img src=./uploads/" . $row['privacy'] . "/" . $row['picture'] . ">";
                                                            echo "</div>"
                                                            ?> -->

                                                    <!--PROFILE PICTURE-->
                                                </div>
                                            </div>
                                        </div>



                                        <!--THIRD PANE-->
                                        <h4 class="info-text">Image Metadata</h4>
                                        <!--IMAGE DETAILS-->
                                        <div class="info-text">
                                            <label>Size <small><?php echo $fileSize; ?> kb </small></label>
                                            <label>Format: <small><?php echo $MimeType; ?></small></label>
                                        </div>
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
                                                <input name="uploaded" type="datetime-local" class="form-control" value="<?php echo date('Y/m/d h:i', $row['dateTimeOriginal']); ?>" required>
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
                                        <h5 class="info-text">Optional Information</h5>
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
            <hr />
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