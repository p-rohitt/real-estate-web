<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");

///search code

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta Tags -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Homex template">
  <meta name="keywords" content="">
  <meta name="author" content="Unicoder">
  <link rel="shortcut icon" href="images/favicon.ico">

  <!--	Fonts
    ========================================================-->
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

  <!--	Css Link
    ========================================================-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/layerslider.css">
  <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <!--	Title
    =========================================================-->
  <title>Bongora Tehsildar</title>
</head>

<body>

  <!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
    <div class="d-flex justify-content-center y-middle position-relative">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
</div>
-->


  <div id="page-wrapper">
    <div class="row">
      <!--	Header start  -->
      <?php include("include/header.php"); ?>
      <!--	Header end  -->

      <!--	Banner   --->
      <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Grid</b>
              </h2>
            </div>
            <div class="col-md-6">
              <nav aria-label="breadcrumb" class="float-left float-md-right">
                <ol class="breadcrumb bg-transparent m-0 p-0">
                  <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Property Grid</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!--	Banner   --->

      <!--	Property Grid
        ===============================================================-->
      <div class="full-row">
        <div class="container">
          <div class="row">

            <div class="col-lg-8">
              <div class="row">

                <?php

                if (isset($_REQUEST['filter'])) {
                  $type = $_REQUEST['type'];
                  $stype = $_REQUEST['stype'];
                  $city = $_REQUEST['city'];
                  $min_price = $_POST['min_price'] ?? null;
                  $max_price = $_POST['max_price'] ?? null;
                  $bhk = $_POST['bhk'] ?? null;
                  $min_year = $_POST['age'] ?? null;


                  $sql = "SELECT * FROM property WHERE type='{$type}' and sale_type='{$stype}' and city='{$city}' and status = 'Available' ";

                  if($min_price !=null){
                    $sql .= " AND price >=  '$min_price'";
                  }
                  if($max_price != null){
                    $sql .= " AND price <= '$max_price' ";
                  }
                  if($bhk != null){
                    $sql .= " AND bhk = '$bhk'";
                  }
                  if($min_year!= null){
                    $sql.= " AND DATEDIFF(NOW(),time)/365 <=  '$min_year'";
                  }
                  //SELECT * FROM `property` WHERE type='office' or type='office' and stype='sale' or stype='rent' and city='valsad' OR state='mumbai'
                  //SELECT * FROM `property` WHERE type='office' and stype='sale'  and city='valsad' OR state='mumbai'
                  $result = mysqli_query($con, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    if ($result == true) {
                      while ($row = mysqli_fetch_array($result)) {
                        $agent = $row['2'];
                        $q = "SELECT agent_name from agent where {$agent} = agent.agent_id";
                        $res = mysqli_query($con, $q);
                        $row2 = mysqli_fetch_array($res);
                ?>

                        <div class="col-md-6">

                          <div class="featured-thumb hover-zoomer mb-2 ">
                            <!-- <div class="overlay-black overflow-hidden position-relative"> -->
                            <?php
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row[14]) . '"/>';
                              ?>
                            <div class="sale bg-secondary text-white">For <?php echo $row['11']; ?></div>
                            <div class="price text-primary text-capitalize">
                              <span class="text-white"><?php echo $row['9']; ?> Sqft</span>
                            </div>
                          </div>




                          <div class="featured-thumb-data shadow-one">
                            <div class="p-4">
                              <h5 class="text-secondary hover-text-primary mb-2 text-capitalize"><a href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo $row['8'] . " bed " . $row['3'] . " @ ₹" . $row['4']; ?></a>
                              </h5>
                              <span class="location text-capitalize"><i class="fas fa-map-marker-alt text-primary"></i>
                                <?php echo $row['5']; ?></span>
                            </div>
                            <div class="px-4 pb-4 d-inline-block w-100">
                              <div class="float-left text-capitalize"><i class="fas fa-user text-primary mr-1"></i>By :
                                <?php echo $row2['0']; ?></div>
                              <div class="float-right"><i class="far fa-calendar-alt text-primary mr-1"></i> <?php echo $row['12']?>
                              </div>
                            </div>
                          </div>
                        </div>



                <?php
                      }
                    }
                  } else {
                    echo "<h1 class='mb-5'><center>No Property Available</center></h1>";
                  }
                }

                ?>




                <!--    <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-4">
                                        <li class="page-item disabled"> <span class="page-link">Previous</span> </li>
                                        <li class="page-item active" aria-current="page"> <span class="page-link"> 1 <span class="sr-only">(current)</span> </span> </li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">...</li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"> <a class="page-link" href="#">Next</a> </li>
                                    </ul>
                                </nav>
                       
                            </div>  -->
              </div>
            </div>

            <div class="sidebar-widget mt-5">
            
              <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Recent
                Property Added</h4>
              <ul class="property_list_widget">

                <?php
                $query = mysqli_query($con, "SELECT * FROM `property` ORDER BY time DESC LIMIT 4");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                  <!-- removed desc limimt 6 from here -->
                  <?php
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row[14]) . ' " width = "200" height = "200" />';
                              ?>

                  <li>
                    <h6 class="text-secondary hover-text-primary text-capitalize"><a href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo $row['3'] . " in " . $row[6] ; ?></a>
                    </h6>
                    <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i>
                      <?php echo $row['5']; ?></span>

                  </li>
                <?php } ?>


              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>


    <!--	Footer   start-->

    <!--	Footer   start-->

    <!-- Scroll to top -->
    <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
    <!-- End Scroll To top -->
  </div>
  </div>
  <!-- Wrapper End -->

  <!--	Js Link
============================================================-->
  <script src="js/jquery.min.js"></script>
  <!--jQuery Layer Slider -->
  <script src="js/greensock.js"></script>
  <script src="js/layerslider.transitions.js"></script>
  <script src="js/layerslider.kreaturamedia.jquery.js"></script>
  <!--jQuery Layer Slider -->
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/tmpl.js"></script>
  <script src="js/jquery.dependClass-0.1.js"></script>
  <script src="js/draggable-0.1.js"></script>
  <script src="js/jquery.slider.js"></script>
  <script src="js/wow.js"></script>

  <script src="js/custom.js"></script>
</body>

</html>