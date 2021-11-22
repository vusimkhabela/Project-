<?php

include("function.php");
include("connect.php");
session_start();
error_reporting(0);



if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {


    $email = $_COOKIE['name'];

    // $info = mysqli_query($conn, "SELECT id, firstname, lastname, gender, num, country, profilepicture, hobby, tagline FROM register WHERE email='$email'");
    // $retrieve = mysqli_fetch_array($info);

    // if ($retrieve != null) {
    //     $firstname = $retrieve['firstname'];
    //     $lastname = $retrieve['lastname'];
    //     $radio = isset($retrieve['gender']);
    //     $num = $retrieve['num'];
    //     $country = $retrieve['country'];
    //     $profilepicture = $retrieve['profilepicture'];
    //     $checkbox1 = isset($retrieve['hobby']);
    //     $tagline = $retrieve['tagline'];
    // } else {
    //     //     $result_id = visited person's profile id
    //     //     $info2 = mysqli_query($conn, "SELECT id, firstname, lastname, gender, num, country, profilepicture, hobby, tagline FROM register WHERE id='$email'");
    //     // $retrieve2 = mysqli_fetch_array($info2);
    // }

    // $userID = $retrieve['id'];

    // $display = mysqli_query($conn, "SELECT * FROM metadata_management WHERE userid = '$userID'");
    // $retriever = mysqli_fetch_array($display);

    // if ($retriever != null) {
    //     $gallery_id = $retriever['galleryid'];
    //     // $g_id = $gallery_id;
    //     $picture = $retriever['picture'];
    //     $title = $retriever['title'];
    //     $privacy = $retriever['privacy'];
    //     // $metadata = $retrieve['metadata'];

    // }




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
                    <a href="editprofile.php" data-toggle="dropdown" data-target="#menu-messages" class="btn"><i class="icon icon-envelope"></i>
                        Profile
                        <ul class="dropdown-menu">
                            <li><a class="btn" title="" href="upload.php">Upload</a></li>
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

        <div class="wizard-content" data-color="green">
            <div class="wizard-header text-center">
                <h1 class="wizard-title">Personal Space</h1>
                <h3 class="wizard-title">What would you like to upload?</h3>
                <p class="category">Acceptable format: jpg, png, jpeg, raw</p>

                <p class="category">
                    <?php echo $email; ?>
                </p>

            </div>
        </div>

        <?php
        if (isset($_POST['view_user'])) {
            $_id = $_POST['user_id'];

            $query = "SELECT * FROM register WHERE id = '$_id' ";
            $query_run = mysqli_query($conn, $query);

            if ($display = mysqli_query($conn, "SELECT * FROM metadata_management WHERE userid = '$_id'
            ")) {

                print_r("Got Data");
            } else {
                print_r("No Data");
            }


            foreach ($query_run as $row) {
                if ($row['id'] != null) {
                    echo "Success Loading User!";
                    print_r("NAME: " . $row['firstname']);
                    print_r("NAME: " . $row['lastname']);
                    print_r($_id);
                } else {
                    echo "Failed loading User";
                }
        ?>
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
                                    <h3 class="name"><?php echo ucfirst($row['firstname']) . " " . ucfirst($row['lastname']); ?></h3>
                                    <p class="post"><?php echo $row['tag']; ?></p>
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

                    <div class="col-sm-8">
                        <hr />
                        <div class="widget-box">
                            <h3 class="widget-title"> <span>MY</span> DETAILS</h3>


                            <div class="info">
                                <h5> <span> Name : </span><?php echo ucfirst($row['firstname']); ?> </h5>
                                <h5> <span> Surname : </span><?php echo ucfirst($row['lastname']); ?></h5>
                                <h5> <span> Gender : </span> <?php echo ucfirst($row['gender']); ?> </h5>
                                <h5> <span> Hobbies : </span><?php echo $row['hobby']; ?></h5>
                                <h5> <span> Country : </span><?php echo ucfirst($row['firstname']); ?></h5>
                            </div>
                            <hr />
                            <section class="picturesuploaded" id="picturesuploaded">
                                <div class="popup">
                                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="upload_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="upload_user" class="btn btn-primary">UPLOAD</button>
                                    </form>
                                </div>
                                <h3 class="heading"> MY <span>PICTURES</span></h3>


                                <div class="photo_gallery">

                                    <?php
                                    while ($row = mysqli_fetch_array($display)) {
                                        if ($row['privacy'] = "timeline") {
                                    ?>
                                        <div class='hovereffects'>
                                            <img class='img-thumbnail' src=<?php echo "'./uploads/timeline/" . $row['picture'] . "'"; ?>>
                                            <div class='overlay'>
                                                <h2><?php echo $row['title']; ?></h2>
                                                <?php
                                                echo "<a class='btn' data-lightbox='mygallery' title='Album: " . $row['album'] . "(" . $row['tag'] . "), By: " . $row['author'] . ", At: " . $row['plocation'] .
                                                    ". Image Exposure: " . $row['exposureTime'] . ", Image ISO Rate: " . $row['isoSpeedRatings'] .
                                                    ", Image Privacy: " . $row['privacy'] . " ' href='./uploads/timeline/" . $row['picture'] . "'>View Image Info</a>";
                                                ?>
                                                <form action="metadata.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="edit_id" value="<?php echo $row['galleryid']; ?>">
                                                    <button type="submit" name="edit_metadata" class="btn btn-primary">EDIT</button>
                                                </form>
                                                <form action="index.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="delete_id" value="<?php echo $items['galleryid']; ?>">
                                                    <button type="submit" name="delete_metadata" class="btn btn-danger">DELETE</button>
                                                </form>
                                                <button class='btn'><a href="<?php echo "./uploads/timeline/" . $row['picture']; ?>" download>
                                                        DOWNLOAD
                                                    </a></button>

                                            </div>
                                        </div>
                                    <?php } }
                                    ?>
                                    <?php
                                    if ($row['privacy'] = "private") {
                                    ?>
                                        <div class='hovereffects'>
                                            <img class='img-thumbnail' src=<?php echo "'./uploads/private/" . $rows['picture'] . "'"; ?>>
                                            <div class='overlay'>
                                                <h2>No Access Granted</h2>
                                                <form action="editprofile.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name=" " value=" ">
                                                    <button type=" " name="request_permission" class="btn btn-danger">REQUEST PERMISSION</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </section>

                        </div>
                    </div>
                    <hr />
                </div>
        <?php

            }
        }

        ?>

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