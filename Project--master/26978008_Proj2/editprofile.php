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

        <!-- <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="index.html"><span>Home</span></a></li>
                <li class="has-children">
                  <a href="about.html"><span>Dropdown</span></a>
                  <ul class="dropdown arrow-top">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                    <li class="has-children">
                      <a href="#">Dropdown</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                        <li><a href="#">Menu Four</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="listings.html"><span>Listings</span></a></li>
                <li><a href="about.html"><span>About</span></a></li>
                <li><a href="blog.html"><span>Blog</span></a></li>
                <li><a href="contact.html"><span>Contact</span></a></li>
              </ul>
            </nav>
          </div> -->
        <div id="user-nav" class="navbar">
            <ul class="navbar nav">
                <li>
                    <a class="btn" href="index.php"><i class="icon icon-user"></i>Home</a>
                </li>
                <li class="dropdown" id="menu-messages">
                    <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="btn"><i class="icon icon-envelope"></i>
                        Profile
                        <ul class="dropdown-menu">
                            <li><a class="sAdd" title="" href="editprofile.php">My Space</a></li>
                            <li><a class="sInbox" title="" href="upload.php">Upload Image</a></li>
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




        <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>


        <!-- <nav class="navbar">
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
        </nav> -->

        <div class="wizard-content" data-color="green">
            <div class="header text-center">
                <h1 class="wizard-title">VEE GALLERY</h1>
                <h3 class="wizard-title">Welcome To Your Personal Space</h3>
                <p class="category">"Share, Manage, Discover"</p>

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
                                            echo "uploads/profilepictures" . $profilepicture;
                                        } ?>' alt="Profile Picture">
                            <h3 class="name"><?php echo ucfirst($firstname) . " " . ucfirst($lastname); ?></h3>
                            <p class="post"><?php echo $tagline; ?></p>
                            <p class="post"> Hobbies : </span><?php echo $hobby; ?></h5>
                            <p class="post">(<?php echo ucfirst($country); ?>)</p>
                        </div>

                        <nav class="navbar-user">
                            <ul>
                                <li><a href="#bio">Change Profile Picture</a></li>
                                <li><a href="#picturesuploaded">Change Password</a></li>
                                <li><a href="#education">Albums</a></li>
                                <li><a href="#chats">Chats</a></li>
                            </ul>
                        </nav>

                        <nav class="navbar">
                            <li class="btn"><a href="https://facebook.com/login/"><i class="ti-facebook"></i></a></li>
                            <li class="btn"><a href="https://twitter.com/login/"><i class="ti-twitter"></i></a></li>
                            <li class="btn"><a href="https://instagram.com/login/"><i class="ti-instagram"></i></a></li>
                            <li class="btn"><a href="https://facebook.com/login/"><i class="ti-google"></i></a></li>
                        </nav>
                    </header>
                </div>
                <hr />

                <div class="col-sm-7">
                    <div class="row">
                        Vee_Gallery is a Web application that is creatively and innovatively designed to
                        allow users to visually share and discover metadata information by uploading photos
                        publicly or privately and to allow users to browse what other users have posted onto
                        the main gallery. </>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="widget-box">

                    <section class="picturesuploaded" id="picturesuploaded">
                        <div class="popup">
                            <a href="upload.php"><button class="btn">Upload<i class="ti-upload"></i></button></a>
                        </div>
                        <hr />
                        <h3 class="heading">PICTURES</h3>

                        <div class="photo_gallery">
                            <?php
                            while ($row = mysqli_fetch_array($display)) { ?>
                                <div class='hovereffects'>
                                    <img class='img-thumbnail' src=<?php echo "'./uploads/timeline/" . $row['picture'] . "'"; ?>>
                                    <div class='overlay'>
                                        <h2><?php echo $row['title']; ?></h2>
                                        <?php
                                        echo "<button class='btn btn-primary' data-lightbox='mygallery' title='Album: " . $row['album'] . "(" . $row['tag'] . "), By: " . $row['author'] . ", At: " . $row['plocation'] .
                                            ". Image Exposure: " . $row['exposureTime'] . ", Image ISO Rate: " . $row['isoSpeedRatings'] .
                                            ", Image Privacy: " . $row['privacy'] . " ' href='./uploads/timeline/" . $row['picture'] . "'><i class='ti-gallery'> </i> VIEW INFO</button>";
                                        // echo "<a class='btn' name='submit' href=''>Edit Metadata Image</a>";
                                        // echo "<a class='btn' href='#'>Delete Image</a>";
                                        // echo "<a class='btn' href='#'>Download Image</a>";
                                        ?>
                                        <form action="metadata.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['galleryid']; ?>">
                                            <button type="submit" name="edit_metadata" class="btn btn-secondary">
                                                <i class="ti-write"></i> EDIT</button>
                                        </form>
                                        <form action="index.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="delete_id" value="<?php echo $items['galleryid']; ?>">
                                            <button type="submit" name="delete_metadata" class="btn btn-danger">
                                                <i class="ti-close"> </i> DELETE</button>
                                        </form>
                                        <button class='btn'><a href="<?php echo "./uploads/timeline/" . $row['picture']; ?>" download>
                                                <i class="ti-download"> </i>DOWNLOAD</a></button>


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