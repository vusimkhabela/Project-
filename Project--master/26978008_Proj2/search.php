<?php

include("function.php");
include("connect.php");
session_start();
error_reporting(0);



if (logged_in()) {
    header("location:login.php");
} else if (isset($_COOKIE['name'])) {


    $email = $_COOKIE['name'];


    // $info = mysqli_query($conn, "SELECT id, firstname, lastname, gender, num, country, profilepicture, hobby, tagline 
    // FROM register WHERE CONCAT(firstname,lastname,gender,country) LIKE '%$filtervalues%' ");
    // $retrieve = mysqli_fetch_array($info);
    // $query_search = mysqli_query($info);
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
    if (isset($_POST['delete_metadata'])) {
        $_id = $_POST['delete_id'];

        $query = "SELECT * FROM metadata_management WHERE galleryid = '$_id'";
        $query_run = mysqli_query($conn, $query);

        foreach ($query_run as $row) {
            if ($img_path = $pictureuploaded = "./uploads/" . $row['privacy'] . "/" . $row['picture']) {
                $query1 = "DELETE FROM metadata_management WHERE galleryid = '$_id'";
                $query1_run = mysqli_query($conn, $query1);

                if ($query_run) {
                    unlink($img_path);
                    $query2 = "DELETE FROM gallery WHERE id = '$_id'";
                    $query2_run = mysqli_query($conn, $query2);
                    header("location:search.php");
                } else {
                    print_r("ERROR DELETING FILE!");
                }
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

        <!-- Fonts and Icons -->
        <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <div class="container">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="">
                        <div class="" data-color="green" id="wizardProfile">
                            <form method="GET" class="search-form" id="search-form">

                                <div class="wizard-header text-center">
                                    <h1 class="wizard-title">Search- Wizard</h1>
                                    <h3 class="wizard-title">What would you like to search?</h3>
                                    <p class="category">Metadata or People</p>
                                </div>

                                <div class=" ">

                                    <!--FIRST PANE-->
                                    <div class=" " id=" ">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="search" required class="form-control" value="<?php if (isset($_GET['search'])) {
                                                                                                                                echo $_GET['search'];
                                                                                                                            } ?>" placeholder="Cats">
                                                    <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                                                </div>
                                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='searchbtn' value='Search' center />
                                                <hr />

                                                <?php

                                                if (isset($_GET['search'])) {
                                                    $filtervalues = $_GET['search'];
                                                    $query = "SELECT id, firstname, lastname, country, profilepicture, hobby
                                                                    FROM register WHERE CONCAT(id, firstname, lastname, country, profilepicture, hobby) LIKE '%$filtervalues%' ";
                                                    $query_run = mysqli_query($conn, $query);

                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $items) {
                                                ?>
                                                            <div class="card mt-4">
                                                                <div class="card-body">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> </th>
                                                                                <th>First Name</th>
                                                                                <th>Last Name</th>
                                                                                <th>Gender</th>
                                                                                <th>Country</th>
                                                                                <th>Hobbies</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <tr>
                                                                                <form action="visitprofile.php" method="POST" enctype="multipart/form-data">
                                                                                    <td><button type="submit" name="view_user"> <img src='<?php
                                                                                                                                            if ($items['picture'] == null) {
                                                                                                                                                echo "assets/img/default-avatar.jpg";
                                                                                                                                            } else {
                                                                                                                                                echo "./uploads/profilepictures" . $items['profilepicture'];
                                                                                                                                            } ?>' height="60px" width="60px"></a></td>

                                                                                    <input type="hidden" name="user_id" value="<?php echo $items['id']; ?>">
                                                                                </form>

                                                                                <td><?= $items['firstname']; ?></td>
                                                                                <td><?= $items['lastname']; ?></td>
                                                                                <td><?= $items['gender']; ?></td>
                                                                                <td><?= $items['country']; ?></td>
                                                                                <td><?= $items['hobby']; ?></td>
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="6">No User Found</td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                    <?php
                                                                }
                                                            }
                                                    ?>

                                                    <?php

                                                    if (isset($_GET['search'])) {
                                                        $filtervalues = $_GET['search'];
                                                        $query = "SELECT picture, title, author, plocation, device, album, privacy, galleryid, tag
    FROM metadata_management WHERE CONCAT(picture, title, author, plocation, device, album, privacy, galleryid, tag) LIKE '%$filtervalues%' ";
                                                        $query_run = mysqli_query($conn, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            foreach ($query_run as $items) {
                                                    ?>

                                                                <div class="card mt-4">
                                                                    <div class="card-body">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th> </th>
                                                                                    <th>Title</th>
                                                                                    <th>Author</th>
                                                                                    <th>Geolocation</th>
                                                                                    <th>Device</th>
                                                                                    <th>Album</th>
                                                                                    <th> </th>
                                                                                    <th> </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                <tr>
                                                                                    <td><img src='<?php
                                                                                                    if ($items['picture'] == null) {
                                                                                                        echo "assets/img/default-avatar.jpg";
                                                                                                    } else {
                                                                                                        echo "./uploads/" . $items['privacy'] . "/" . $items['picture'];
                                                                                                    } ?>' height="60px" width="60px"></td>
                                                                                    <td><?= $items['title']; ?></td>
                                                                                    <td><?= $items['author']; ?></td>
                                                                                    <td><?= $items['plocation']; ?></td>
                                                                                    <td><?= $items['device']; ?></td>
                                                                                    <td><?= $items['album']; ?></td>
                                                                                    <td>
                                                                                        <form action="metadata.php" method="POST" enctype="multipart/form-data">
                                                                                            <input type="hidden" name="edit_id" value="<?php echo $items['galleryid']; ?>">
                                                                                            <button type="submit" name="edit_metadata" class="btn btn-primary">EDIT</button>
                                                                                        </form>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="6">No Image Found</td>
                                                                            </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                        <?php
                                                                    }
                                                                }
                                                        ?>


                                            </div>
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