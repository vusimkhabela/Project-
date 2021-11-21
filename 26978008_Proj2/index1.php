<?php

include("function.php");
include("connect.php");
session_start();



if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {

    $email = $_COOKIE['name'];

    // $sql  = "SELECT picture FROM metadata_management WHERE $privacy ='timeline' ORDER BY id DESC";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $picturedata = mysqli_query($conn, "SELECT (picture, title, author, taken, plocation, 
    // device, tag, album, privacy, userid, galleryid)  
    // FROM metadata_management");
    // $mysql = "SELECT * FROM metadata_management";
    // $result = mysqli_query($conn, $mysql);

    $display = mysqli_query($conn, "SELECT * FROM metadata_management");
    $retrieve = mysqli_fetch_array($display);
    $gallery_id = $retrieve['galleryid'];
    $g_id = $gallery_id;
    $picture = $retrieve['picture'];
    $title = $retrieve['title'];
    $privacy = $retrieve['privacy'];
    // $metadata = $retrieve['metadata'];
    $tag = $retrieve['tag'];

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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


        <!--   Big container   -->
        <div class="container">
            <div class="col-dm-7 col-sm-offset-1">
                <!--      Wizard container        -->

                <div class="wizard-header text-center">
                    <h1 class="wizard-title">Home</h1>
                    <h3 class="wizard-title">Latest Posts</h3>
                    <p class="category">View & Share your memories with the community.</p>
                </div>

                <hr />

                <div class="pics-container">
                    <div class="photo-gallery">
                        <div class="row">
                            <?php
                            while ($row = mysqli_fetch_array($display)) {
                                if ($privacy == 'public') {
                                    echo "<div class='pic'>";
                                    echo "<img src='./uploads/timeline/" . $row['picture'] . "' >";
                                    // echo "<p>".$row['image_text']."</p>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr />
            </div>

            <!--fOOTER-->
            <div class="col-sm-7 col-sm-offset-1">
                <div class="row">
                    <h5>No account? <a href>Sign up</a></h5>
                    Tersms of popnsdjcbsghdv shdvchsjdb vhsdv askhdcbhas ck h ashc sj ijasbc sdchva scahs cabscg ascagsvcha scka ashjbcahjdvcbksbcjksbd vkbsdklvnsljvn;ksdmvccz

                </div>
            </div>

            </form>
        </div>


        <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by <a href="https://www.creative-tim.com">Creative Tim</a>. Free download <a href="https://www.creative-tim.com/product/paper-bootstrap-wizard">here.</a>
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