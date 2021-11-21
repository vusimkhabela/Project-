<?php

include("function.php");
include("connect.php");
session_start();
error_reporting(0);



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
  // $author = $retrieve['author'];
  // $uploaded= $retrieve['uploaded'];
  // $plocation=$retrieve['plocation'];
  // $device=$retrieve['device'];
  // $tag=$retrieve['tag'];
  // $album=$retrieve['album'];
  // $fileSize=$retrieve['fileSize'];
  // $MimeType=$retrieve['MimeType'];
  // $exposureTime=$retrieve['exposureTime'];
  // $isoSpeedRatings=$retrieve['isoSpeedRatings'];
  // $focalLength=$retrieve['focalLength'];
  if (isset($_POST['delete_metadata'])) {
    $_id = $_POST['delete_id'];

    $query = "SELECT * FROM metadata_management WHERE galleryid = '$_id' AND privacy ='timeline'";
    $query_run = mysqli_query($conn, $query);

    foreach ($query_run as $row) {
        if ($img_path = $pictureuploaded = "./uploads/" . $row['privacy'] . "/" . $row['picture']) {
            $query1 = "DELETE FROM metadata_management WHERE galleryid = '$_id'";
            $query1_run = mysqli_query($conn, $query1);

            if ($query_run) {
                unlink($img_path);
                $query2 = "DELETE FROM gallery WHERE id = '$_id'";
                $query2_run = mysqli_query($conn, $query2);
                header("location:index.php");
            } else {
                print_r("ERROR DELETING FILE!");
            }
        }else {
          print_r("ERROR DELETING FILE!");
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
    <link href="assets/css/lightbox.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts and Icons -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  </head>


  <body>

  <div id="user-nav" class="navbar">
            <ul class="navbar nav">
                <li>
                    <a class = "btn" href="index.php"><i class="icon icon-user"></i>Home</a>
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
                    <a class ="btn" title="" href="search.php"><i class="icon icon-cog"></i> Search</a>
                </li>
                <li class="">
                    <a class = "btn" title="" href="logout.php"><i class="icon icon-share-alt"></i>
                        Logout</a>
                </li>
            </ul>
        </div>




    <!--div class="image-container set-full-height" style="background-image: url('assets/img/paper-1.jpeg')"-->


    <!--   Big container   -->
    <div class="container">
      <div class="col-dm-7 col-sm-offset-1">
        <form action="metadata.php" method="POST">
          <!--      Wizard container        -->

          <div class="wizard-header text-center">
            <h1 class="wizard-title">Home</h1>
            <h3 class="wizard-title">Latest Posts</h3>
            <p class="category">View & Share your memories with the community.</p>
          </div>

          <hr />
          <div class="photo_gallery">
            <?php
            while ($row = mysqli_fetch_array($display)) { ?>
              <div class='hovereffects'>
                <img class='img-thumbnail' src=<?php echo "'./uploads/timeline/" . $row['picture'] . "'"; ?>>
                <div class='overlay'>
                  <h2><?php echo $row['title']; ?></h2>
                  <?php
                  echo "<a class='btn' data-lightbox='mygallery' title='Album: " . $row['album'] . "(" . $row['tag'] . "), By: " . $row['author'] . ", At: " . $row['plocation'] .
                    ". Image Exposure: " . $row['exposureTime'] . ", Image ISO Rate: " . $row['isoSpeedRatings'] .
                    ", Image Privacy: " . $row['privacy'] . " ' href='./uploads/timeline/" . $row['picture'] . "'>View Image Info</a>";
                  // echo "<a class='btn' name='submit' href=''>Edit Metadata Image</a>";
                  // echo "<a class='btn' href='#'>Delete Image</a>";
                  // echo "<a class='btn' href='#'>Download Image</a>";
                  ?>
                  <form action="metadata.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $row['galleryid']; ?>">
                    <button type="submit" name="edit_metadata" class="btn btn-primary">EDIT</button>
                  </form>
                  <form action="index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="delete_id" value="<?php echo $items['galleryid']; ?>">
                    <button type="submit" name="delete_metadata" class="btn btn-danger">DELETE</button>
                  </form>
                  <button class='btn'><a href= "<?php echo "./uploads/timeline/". $row['picture']; ?>" download>
                                                                                DOWNLOAD
                                                                                </a></button>
                </div>
              </div>
            <?php }
            ?>

          </div>





        </form>
      </div>


      <div class="preview-box">
        <div class="details">
          <span class="title">Image <p class="current-img"></p> of <p class="total-img"></p></span>
          <span class="icon fas fa-times"></span>
        </div>
        <div class="image-box">
          <img src="" alt="">
        </div>
      </div>
      <div class="preview_shadow"></div>





      <hr />
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"> <i class="icon-refresh"></i> </span>
            <h5>News updates</h5>
          </div>
          <div class="widget-content nopadding updates">
            <div class="new-update clearfix">
              <i class="icon-ok-sign"></i>
              <div class="update-done">
                <a title="" href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit.</strong></a>
                <span>dolor sit amet, consectetur adipiscing eli</span>
              </div>
              <div class="update-date">
                <span class="update-day">20</span>jan
              </div>
            </div>
            <div class="new-update clearfix">
              <i class="icon-gift"></i>
              <span class="update-notice">
                <a title="" href="#"><strong>Congratulation Maruti, Happy Birthday
                  </strong></a>
                <span>many many happy returns of the day</span>
              </span>
              <span class="update-date"><span class="update-day">11</span>jan</span>
            </div>
            <div class="new-update clearfix">
              <i class="icon-move"></i>
              <span class="update-alert">
                <a title="" href="#"><strong>Maruti is a Responsive Admin theme</strong></a>
                <span>But already everything was solved. It will ...</span>
              </span>
              <span class="update-date"><span class="update-day">07</span>Jan</span>
            </div>
            <div class="new-update clearfix">
              <i class="icon-leaf"></i>
              <span class="update-done">
                <a title="" href="#"><strong>Envato approved Maruti Admin template</strong></a>
                <span>i am very happy to approved by TF</span>
              </span>
              <span class="update-date"><span class="update-day">05</span>jan</span>
            </div>
            <div class="new-update clearfix">
              <i class="icon-question-sign"></i>
              <span class="update-notice">
                <a title="" href="#"><strong>I am alwayse here if you have any question</strong></a>
                <span>we glad that you choose our template</span>
              </span>
              <span class="update-date"><span class="update-day">01</span>jan</span>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="tab-content">
      <!--TIMELINE-->
      <div class="tab-pane" id="login">
        <div class="row">
          <div class="col-sm-12">


            <h5 class="info-text"> OR </h5>

            <div class="form-group">
              <input name="email" type="email" class="form-control" placeholder="Email Address">
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control" placeholder="***********">
              <a href>Forgotten Password?</a>
            </div>
            <div class="form-group">
              <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
              <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
            </div>

          </div>

        </div>
      </div>
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
  <script src="assets/js/lightbox-plus-jquery.min.js" type="text/javascript"></script>

  <!--  Plugin for the Wizard -->
  <script src="assets/js/demo.js" type="text/javascript"></script>
  <script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

  <!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
  <script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

  </html>
<?php

}

?>