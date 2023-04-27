<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $type = isset($_POST['type']) ? $_POST['type'] : null;
  $stype = isset($_POST['stype']) ? $_POST['stype'] : null;

  $min_price = $_POST['min_price'] ?? null;
  $max_price = $_POST['max_price'] ?? null;
  $bhk = $_POST['bhk'] ?? null;
  $min_year = $_POST['min_year'] ?? null;

  // Construct the SQL query based on the search parameters
  $query = 'SELECT * FROM property WHERE 1=1 and status = `Available` ';
  if ($type != null) {
    $query .= ' AND type = ' . mysqli_real_escape_string($conn, $type);
  }
  if ($stype) {
    $query .= 'AND sale_type = ' . mysqli_real_escape_string($conn, $stype);
  }

  if ($min_price !== null) {
    $query .= ' AND price >= ' . mysqli_real_escape_string(
      $conn,
      $min_price
    );
  }
  if ($max_price !== null) {
    $query .= ' AND price <= ' .
      mysqli_real_escape_string($conn, $max_price);
  }
  if ($bhk !== null) {
    $query .= '
AND bhk = ' . mysqli_real_escape_string($conn, $bhk);
  }
  if ($min_year !== null) {
    $currdate = NOW();
    $sub = $min_year . '-01-01';
    $currdate = $currdate - $sub;

    $query .= ' AND  time >= '. mysqli_real_escape_string($con,$currdate) . ' year';
  } // Execute the query and fetch the results $result =
  mysqli_query($conn, $query);
  $properties = mysqli_fetch_all(
    $result,
    MYSQLI_ASSOC
  );
} else {
  $properties = [];
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!--	Fonts
    ========================================================-->
    <link
      href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Comfortaa:400,700"
      rel="stylesheet"
    />

    <!--	Css Link
    ========================================================-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/layerslider.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="css/color.css"
      id="color-change"
    />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!--	Title
    =========================================================-->
    <title>Bongora Tehsildar</title>
  </head>

  <body>
    
    <div id="page-wrapper">
      <div class="row">
        <!--	Header start  -->
        <?php include("include/header.php"); ?>
        <!--	Header end  -->

        <!--	Banner Start   -->
        <div
          class="overlay-black w-100 slider-banner1 position-relative"
          style="
            background-image: url('https://c.pxhere.com/photos/20/1d/city_city_wallpaper_fog_high_rises_mist_pollution_real_estate_skyline-919711.jpg!d');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
          "
        >
          <div class="container h-100">
            <div class="row h-100 align-items-center">
              <div class="col-lg-12">
                <div class="text-white">
                  <h1 class="mb-4">
                    <span class="text-dark">Find</span><br />
                    Your dream house
                  </h1>
                  <form method="post" action="propertygrid.php">
                    <div class="row">
                      <div class="col-md-6 col-lg-2">
                        <div class="form-group">
                          <select class="form-control" name="type">
                            <option value="">Select Type</option>
                            <option value="Apartment">Apartment</option>
                            <option value="Flat">Flat</option>
                            <option value="House">House</option>
                            <option value="Villa">Villa</option>
                            <option value="Office">Office</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-2">
                        <div class="form-group">
                          <select class="form-control" name="stype">
                            <option value="">Select Status</option>
                            <option value="Rent">Rent</option>
                            <option value="Sale">Sale</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-2">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="city"
                            placeholder="Enter City"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-2">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="minprice"
                            placeholder="Minimum price:"
                            
                          />
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-2">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="maxprice"
                            placeholder="Maximum price:"
                            
                          />
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-2">
                        <div class="form-group">
                          <input
                            type="number"
                            name="bhk"
                            class="form-control"
                            placeholder="BHK"
                            
                          />
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-2">
                        <div class="form-group">
                          <input
                            type="number"
                            class="form-control"
                            name="age"
                            placeholder="Max Age"
                            
                          />
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-2">
                        <div class="form-group">
                          <button
                            type="submit"
                            name="filter"
                            class="btn w-100 text-white"
                            style = "background-color:black"
                          >
                            Search Property
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--	Banner End  -->

        <!--	Recent Properties  -->
        <div class="full-row">
          <div class="container" >
            <div class="row">
              <div class="col-md-12">
                <h2 class="text-secondary text-center mb-4">
                  Recent Property
                </h2>
              </div>
              
              <div class="col-md-12">
                <div class="tab-content mt-4" id="pills-tabContent">
                  <div
                    class="tab-pane fade show active"
                    id="pills-home"
                    role="tabpanel"
                    aria-labelledby="pills-home"
                  >
                    <div class="row">
                      <?php $query = mysqli_query($con, "SELECT property.*, seller.seller_id,seller.contact FROM `property`,`seller` WHERE property.seller_id=seller.seller_id and status = 'Available' ORDER BY time DESC LIMIT 9");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>

                                                                        <div class="col-md-6 col-lg-4">
                                                                          <div class="featured-thumb hover-zoomer mb-4">
                                                                            <div
                                                                              class="overlay-black overflow-hidden position-relative"
                                                                            >
                                                                            <?php 
                                                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row[14]) . '"/>';
                                                                            ?>
                                                                            
                                             
                                                                                            <div class="featured bg-dark text-white">
                                                                                              New
                                                                                            </div>
                                                                                            <div
                                                                                              class="sale bg-dark text-white text-capitalize"
                                                                                            >
                                                                                              For
                                                                                              <?php echo $row['sale_type']; ?>
                                                                                            </div>
                                                                                            <div class="price text-white">
                                                                                              <b>₹<?php echo $row[4]; ?> </b
                                                                                              ><span class="text-white"
                                                                                                ><?php echo $row['size']; ?>
                                                                                                Sqft</span
                                                                                              >
                                                                                            </div>
                                                                                          </div>
                                                                                          <div class="featured-thumb-data shadow-one">
                                                                                            <div class="p-3">
                                                                                              <h5
                                                                                                class="text-secondary hover-text-primary mb-2 text-capitalize"
                                                                                              >
                                                                                                <a
                                                                                                  href="propertydetail.php?pid=<?php echo $row['0']; ?>"
                                                                                                  ><?php echo $row['3'] . " in " . $row['6']; ?></a
                                                                                                >
                                                                                              </h5>
                                                                                              <span class="location text-capitalize"
                                                                                                ><i
                                                                                                  class="fas fa-map-marker-alt text-dark"
                                                                                                ></i>
                                                                                                <?php echo $row['5']; ?></span
                                                                                              >
                                                                                            </div>
                                                                                            <div class="bg-gray quantity px-4 pt-4">
                                                                                              <ul>
                                                                                                <li>
                                                                                                  <span><?php echo $row['9']; ?></span> Sqft
                                                                                                </li>
                                                                                                <li>
                                                                                                  <span><?php echo $row['8']; ?></span> Beds
                                                                                                </li>
                                                                                                <li>
                                                                                                  <span><?php echo "1" ?></span> Kitchen
                                                                                                </li>
                                                                                                <li>
                                                                                                  <span><?php echo "2" ?></span> Balcony
                                                                                                </li>
                                                                                              </ul>
                                                                                            </div>
                                                                                            <div class="p-4 d-inline-block w-100">
                                                                                              <div class="float-left text-capitalize">
                                                                                                <i class="fas fa-user text-dark mr-1"></i>Seller
                                                                                                :
                                                                                                <?php

                                                                                                $s = "Select * from seller where seller.seller_id = '$row[1]'";
                                                                                                $p = mysqli_query($con, $s);
                                                                                                $sellerdata = mysqli_fetch_array($p);
                                                                                                echo $sellerdata[4];
                                                                                                
                                                                                                ?>
                                                                                              </div>
                                                                                              <div class="float-right">
                                                                                                <i
                                                                                                  class="far fa-calendar-alt text-dark mr-1"
                                                                                                ></i>
                                                                                                Built: <?php echo substr($row['12'], 0, 4) ?>
                                                                                              </div>
                                                                                            </div>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!--	Achievement
        ============================================================-->
        <div
          class="full-row overlay-dark"
          style="
            background-image: url('https://www.nedair.nl/wp-content/uploads/2016/03/Banner-Hicondo.png');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
          "
        >
          <div class="container">
            <div class="fact-counter">
              <div class="row">
                <div class="col-md-3">
                  <div
                    class="count wow text-center mb-sm-50"
                    data-wow-duration="300ms"
                  >
                    <i
                      class="flaticon-house flat-large text-white"
                      aria-hidden="true"
                    ></i>
                    <?php
                    $query = mysqli_query($con, "SELECT count(pid) FROM property");
                    while ($row = mysqli_fetch_array($query)) {
                      ?>
                                                                                                    <div
                                                                                                      class="count-num text-white my-4"
                                                                                                      data-speed="3000"
                                                                                                      data-stop="<?php
                                                                                                      $total = $row[0];
                                                                                                      echo $total; ?>"
                                                                                                    >
                                                                                                      0
                                                                                                    </div>
                    <?php } ?>
                    <div class="text-white h5">Property Available</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div
                    class="count wow text-center mb-sm-50"
                    data-wow-duration="300ms"
                  >
                    <i
                      class="flaticon-house flat-large text-white"
                      aria-hidden="true"
                    ></i>
                    <?php
                    $query = mysqli_query($con, "SELECT count(pid) FROM property where sale_type = 'Sale' and status = 'Available'");
                    while ($row = mysqli_fetch_array($query)) {
                      ?>
                                                                                                    <div
                                                                                                      class="count-num text-white my-4"
                                                                                                      data-speed="3000"
                                                                                                      data-stop="<?php
                                                                                                      $total = $row[0];
                                                                                                      echo $total; ?>"
                                                                                                    >
                                                                                                      0
                                                                                                    </div>
                    <?php } ?>
                    <div class="text-white h5">Sale Property Available</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div
                    class="count wow text-center mb-sm-50"
                    data-wow-duration="300ms"
                  >
                    <i
                      class="flaticon-house flat-large text-white"
                      aria-hidden="true"
                    ></i>
                    <?php
                    $query = mysqli_query($con, "SELECT count(pid) FROM property where sale_type='Rent'");
                    while ($row = mysqli_fetch_array($query)) {
                      ?>
                                                                                                    <div
                                                                                                      class="count-num text-white my-4"
                                                                                                      data-speed="3000"
                                                                                                      data-stop="<?php
                                                                                                      $total = $row[0];
                                                                                                      echo $total; ?>"
                                                                                                    >
                                                                                                      0
                                                                                                    </div>
                    <?php } ?>
                    <div class="text-white h5">Rent Property Available</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div
                    class="count wow text-center mb-sm-50"
                    data-wow-duration="300ms"
                  >
                    <i
                      class="flaticon-man flat-large text-white"
                      aria-hidden="true"
                    ></i>
                    <?php
                    $query = mysqli_query($con, "SELECT count(user_id) FROM user");
                    while ($row = mysqli_fetch_array($query)) {
                      ?>
                                                                                                    <div
                                                                                                      class="count-num text-white my-4"
                                                                                                      data-speed="3000"
                                                                                                      data-stop="<?php
                                                                                                      $total = $row[0];
                                                                                                      echo $total; ?>"
                                                                                                    >
                                                                                                      0
                                                                                                    </div>
                    <?php } ?>
                    <div class="text-white h5">Registered Users</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--	Popular Place -->
        <div class="full-row bg-gray">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <h2 class="text-secondary  text-center mb-5">
                  Popular Places
                </h2>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="row">
                <div class="col-md-6 col-lg-3 pb-1">
                  <div
                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9"
                  >
                    <img src="images/thumbnail4/1.jpg" alt="" />
                    <div
                      class="text-white xy-center z-index-9 position-absolute text-center w-100"
                    >
                      <?php
                      $query = mysqli_query($con, "SELECT count(state), property.* FROM property where state='Gujarat'");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>
                                                                                                      <h4 class="hover-text-primary text-capitalize">
                                                                                                        <a href="stateproperty.php?id=<?php echo $row['17'] ?>"
                                                                                                          ><?php echo $row['state']; ?></a
                                                                                                        >
                                                                                                      </h4>
                                                                                                      <span
                                                                                                        ><?php
                                                                                                        $total = $row[0];
                                                                                                        echo $total; ?>
                                                                                                        Properties Listed</span
                                                                                                      >
                                                                                                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 pb-1">
                  <div
                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9"
                  >
                    <img src="images/thumbnail4/2.jpg" alt="" />
                    <div
                      class="text-white xy-center z-index-9 position-absolute text-center w-100"
                    >
                      <?php
                      $query = mysqli_query($con, "SELECT count(state), property.* FROM property where state='Maharashtra'");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>
                                                                                                      <h4 class="hover-text-primary text-capitalize">
                                                                                                        <a href="stateproperty.php?id=<?php echo $row['17'] ?>"
                                                                                                          ><?php echo $row['state']; ?></a
                                                                                                        >
                                                                                                      </h4>
                                                                                                      <span
                                                                                                        ><?php
                                                                                                        $total = $row[0];
                                                                                                        echo $total; ?>
                                                                                                        Properties Listed</span
                                                                                                      >
                                                                                                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 pb-1">
                  <div
                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9"
                  >
                    <img src="images/thumbnail4/3.jpg" alt="" />
                    <div
                      class="text-white xy-center z-index-9 position-absolute text-center w-100"
                    >
                      <?php
                      $query = mysqli_query($con, "SELECT count(state), property.* FROM property where state='Delhi'");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>
                                                                                                      <h4 class="hover-text-primary text-capitalize">
                                                                                                        <a href="stateproperty.php?id=<?php echo $row['17'] ?>"
                                                                                                          ><?php echo $row['state']; ?></a
                                                                                                        >
                                                                                                      </h4>
                                                                                                      <span
                                                                                                        ><?php
                                                                                                        $total = $row[0];
                                                                                                        echo $total; ?>
                                                                                                        Properties Listed</span
                                                                                                      >
                                                                                                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 pb-1">
                  <div
                    class="overflow-hidden position-relative overlay-secondary hover-zoomer mx-n13 z-index-9"
                  >
                    <img src="images/thumbnail4/4.jpg" alt="" />
                    <div
                      class="text-white xy-center z-index-9 position-absolute text-center w-100"
                    >
                      <?php
                      $query = mysqli_query($con, "SELECT count(state), property.* FROM property where state='Rajasthan'");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>
                                                                                                      <h4 class="hover-text-primary text-capitalize">
                                                                                                        <a href="stateproperty.php?id=<?php echo $row['17'] ?>"
                                                                                                          ><?php echo $row['state']; ?></a
                                                                                                        >
                                                                                                      </h4>
                                                                                                      <span
                                                                                                        ><?php
                                                                                                        $total = $row[0];
                                                                                                        echo $total; ?>
                                                                                                        Properties Listed</span
                                                                                                      >
                                                                                                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--	Popular Places -->

        <!--	Footer   start-->
        <?php include("include/footer.php"); ?>
        <!--	Footer   start-->

        <!-- Scroll to top -->
        <a
          href="#"
          class="bg-primary text-white hover-text-secondary"
          id="scroll"
          ><i class="fas fa-angle-up"></i
        ></a>
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
    <script src="js/YouTubePopUp.jquery.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
