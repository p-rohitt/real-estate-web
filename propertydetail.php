<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");

$btn_msg = "Buy through this agent";
$qu = mysqli_query($con,"SELECT * from property where pid = '$_REQUEST[pid]'");
$propdata = mysqli_fetch_array($qu);
$status = "For " . $propdata['11'];
$btn_css = "";

$q = mysqli_query($con, "SELECT  agent_id from property where pid = '$_REQUEST[pid]'");
$agent = mysqli_fetch_array($q);
$date = date("Y-m-d");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy'])){
    $query = mysqli_query($con, "UPDATE user set user.agent_id = '$agent[0]' where user.user_id = '$_SESSION[uid]'");
    $que = mysqli_query($con, "INSERT INTO record(`pid`,`agent_id`,`time`,`sale_type`,`price`) values ('$_REQUEST[pid]','$agent[0]',NOW(),'$propdata[11]','$propdata[4]')");

    $btn_msg = "Purchased!";
    $btn_css = "disabled";

    if($propdata[11] == 'Sale'){
        $status = "Sold";
    }
    else{
        $status = "Rented";
    }

    $que = mysqli_query($con, "UPDATE property set status = '$status' where property.pid = '$_REQUEST[pid]'");
    $que = mysqli_query($con, "UPDATE property set user_id = '$_SESSION[uid]' where property.pid = $_REQUEST[pid]");
}

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
    <title>Homex - Real Estate Template</title>
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
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Property Detail</b>
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Property Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Banner   --->


            <div class="full-row">
                <div class="container">
                    <div class="row">

                        <?php
                        $id = $_REQUEST['pid'];
$query = mysqli_query($con, "SELECT property.*, agent.* FROM `property`,`agent` WHERE property.agent_id=agent.agent_id and pid='$id'");
while ($row = mysqli_fetch_array($query)) {
    $_GLOBAL['agent_id'] = $row['16'];
    ?>

                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row[14]) . '"/>';
                                        ?>
                                        <div class="row mb-4 mt-4">
                                            <div class="col-md-6">
                                                <div class="bg-dark d-table px-3 py-2 rounded text-white text-capitalize">
                                                    <?php echo $status; ?></div>
                                                <h5 class="mt-2 text-secondary text-capitalize"><?php echo $row['3']. " in " . $row['5'] . ", " . $row['6']; ?></h5>
                                                <span class="mb-sm-20 d-block text-capitalize"><i class="fas fa-map-marker-alt text-dark font-12"></i>
                                                    &nbsp;<?php echo $row['5']; ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-dark text-left h5 my-2 text-md-right">₹<?php echo $row['4']; ?>
                                                </div>
                                                <div class="text-left text-md-right">Price</div>
                                            </div>
                                        </div>
                                        <div class="property-details">
                                            <div class="bg-gray property-quantity px-4 pt-4 w-100">
                                                <ul>    
                                                    <li><span class="text-secondary"><?php echo $row['9']; ?></span> Sqft</li>
                                                    <li><span class="text-secondary"><?php echo $row['8']; ?></span> Bedroom</li>
                                                    <li><span class="text-secondary"><?php echo $row['8'] + 1; ?></span> Bathroom</li>
                                                    <li><span class="text-secondary"><?php echo $row['8'] % 3 + 1; ?></span> Balcony</li>
                                                    <li><span class="text-secondary"><?php echo $row['8']; ?></span> Hall</li>
                                                    <li><span class="text-secondary"><?php echo 1; ?></span> Kitchen</li>
                                                </ul>
                                            </div>
                                            <h4 class="text-secondary my-4">Description</h4>
                                            <p><?php echo "Hola Buyer! Good choice we'd say ;) The property you're viewing is a " . $row['8'] . "BHK " . $row['3'] . ", situated right around the core of the city of " . $row['6'] . " in " . $row['5'] . ". The rest of the details is mentioned below. Happy Purchasing!"; ?></p>

                                            <h5 class="mt-5 mb-4 text-secondary">Property Summary</h5>
                                            <div class="table-striped font-14 pb-2">
                                                <table class="w-100">
                                                    <tbody>
                                                        <tr>
                                                            <td>BHK :</td>
                                                            <td class="text-capitalize"><?php echo $row['8']; ?></td>
                                                            <td>Property Type :</td>
                                                            <td class="text-capitalize"><?php echo $row['3']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Floor :</td>
                                                            <td class="text-capitalize"><?php echo $row['8']; ?></td>
                                                            <td>Total Floor :</td>
                                                            <td class="text-capitalize"><?php echo $row['8'] % 3 + 1; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>City :</td>
                                                            <td class="text-capitalize"><?php echo $row['6']; ?></td>
                                                            <td>State :</td>
                                                            <td class="text-capitalize"><?php echo $row['7']; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row[15]) . '" height="500" width = "200"  />';
                                            ?>
                                            <h5 class="mt-5 mb-4 text-secondary">Look at what the owner has to say:</h5>
                                            <div class="row">
                                                <?php if ($row['3'] == 'Apartment') {
                                                    echo
                                                        "Welcome to this stunning " . $row['8'] . "-bedroom apartment, located in the heart of the bustling city center. This beautiful property boasts a spacious and modern interior with high-quality finishes and fittings throughout.

                                                            Upon entering the apartment, you are greeted by a bright and inviting living area, featuring large windows that flood the space with natural light. The open-plan living and dining area offers plenty of room for entertaining, with a comfortable seating area and a dining table perfect for dinner parties.
                                                            
                                                            The fully equipped kitchen is modern and functional, with sleek cabinetry, stainless steel appliances, and ample counter space for preparing meals. The bedroom is a peaceful haven, with a comfortable bed and plenty of storage space for your belongings. The stylish bathroom features contemporary fixtures and finishes, including a walk-in shower.
                                                            
                                                            Residents of this apartment also have access to fantastic amenities, including a gym, pool, and 24-hour concierge service. With its unbeatable location in the heart of the city, this apartment is perfect for those looking for a convenient and luxurious urban lifestyle.
                                                            
                                                            Don't miss out on the opportunity to make this beautiful apartment your new home. Contact us today to schedule a viewing!";
                                                } elseif ($row['3'] == 'House') {
                                                    echo " Welcome to this beautiful and spacious " . $row['8'] . "-bedroom house, located in a peaceful and family-friendly neighborhood. This charming property offers a comfortable and functional living space, perfect for families and those who love to entertain.

                                                Upon entering the house, you are greeted by a bright and welcoming foyer that leads to a spacious living room, featuring large windows that offer plenty of natural light. The living room flows seamlessly into the dining area, which is perfect for hosting dinner parties and family gatherings.
                                                
                                                The fully equipped kitchen is modern and stylish, with high-end appliances, granite countertops, and plenty of storage space for all your cooking needs. The house also features four generously sized bedrooms, each with ample closet space and large windows that offer beautiful views of the surrounding neighborhood.
                                                
                                                The master bedroom is a true retreat, with a spacious en-suite bathroom featuring a large soaking tub, walk-in shower, and double vanity. The other bedrooms share a well-appointed bathroom, complete with a bathtub and shower.
                                                
                                                The house also boasts a large backyard, perfect for outdoor activities and barbecues with friends and family. The attached garage offers plenty of storage space, and there is ample parking in the driveway for multiple cars.
                                                
                                                Located in a quiet and family-friendly neighborhood, this house is just minutes away from great schools, shopping centers, and restaurants. With its spacious living areas, modern amenities, and convenient location, this house is the perfect place to call home.
                                                
                                                Don't miss out on the opportunity to make this stunning house your new home. Contact us today to schedule a viewing!";
                                                } elseif ($row['3'] == 'Office') {
                                                    echo "Welcome to this modern and spacious office space, located in a prime commercial area. This impressive property boasts a professional and stylish interior, perfect for businesses of all sizes.

                                                Upon entering the office, you are greeted by a bright and welcoming reception area, with comfortable seating and a sleek reception desk. The office space offers a variety of work areas, including private offices, conference rooms, and open workspaces, perfect for accommodating different business needs and work styles.
                                                
                                                The private offices are spacious and well-lit, with large windows that offer stunning views of the surrounding city. The conference rooms are fully equipped with state-of-the-art audiovisual equipment and comfortable seating, perfect for hosting meetings and presentations.
                                                
                                                The open workspaces are designed for collaboration and teamwork, with comfortable seating and plenty of natural light. The kitchen and break room are spacious and modern, with high-end appliances, ample seating, and plenty of counter space for preparing and enjoying meals.
                                                
                                                The office also features high-speed internet, dedicated phone lines, and a 24-hour security system, providing a safe and secure working environment for all employees.
                                                
                                                Located in a prime commercial area, this office space is just minutes away from restaurants, cafes, and shopping centers, making it the perfect location for businesses looking to attract and retain top talent.
                                                
                                                With its modern amenities, professional atmosphere, and prime location, this office space is the perfect place to take your business to the next level. Contact us today to schedule a viewing!";
                                                } elseif ($row['3'] == 'Villa') {
                                                    echo "Welcome to this breathtaking villa, nestled in a secluded and private location with stunning views of the surrounding mountains and countryside. This luxurious property boasts a beautiful and spacious interior, with high-end finishes and attention to detail throughout.

                                                Upon entering the villa, you are greeted by a grand foyer with high ceilings and elegant decor. The spacious living room features large windows that offer beautiful views of the surrounding landscape, and a cozy fireplace perfect for chilly evenings. The dining area is perfect for hosting dinner parties, with ample seating and beautiful chandeliers that create an elegant atmosphere.
                                                
                                                The fully equipped kitchen is a chef's dream, with high-end appliances, beautiful countertops, and plenty of space for preparing and cooking meals. The villa also features four generously sized bedrooms, each with a private en-suite bathroom and beautiful views of the surrounding landscape.
                                                
                                                The master bedroom is a true oasis, with a spacious en-suite bathroom featuring a large soaking tub, walk-in shower, and double vanity. The other bedrooms are also well-appointed, with comfortable bedding and beautiful decor.
                                                
                                                The villa also features a beautiful outdoor area, complete with a large swimming pool, plenty of lounge chairs for sunbathing, and a beautiful pergola with comfortable seating for enjoying the views and relaxing in the shade.
                                                
                                                Located in a secluded and private location, this villa offers a serene and peaceful escape from the hustle and bustle of everyday life. With its luxurious amenities, beautiful interior, and stunning views, this villa is the perfect place to relax and unwind in style.
                                                
                                                Don't miss out on the opportunity to make this stunning villa your new home. Contact us today to schedule a viewing!";
                                                } elseif ($row['3'] == 'Flat') {
                                                    echo "Welcome to this beautiful and spacious " . $row['8'] . "-bedroom flat, located in a sought-after residential area. This stunning property offers a comfortable and functional living space, perfect for individuals or couples looking for a stylish and convenient urban lifestyle.

                                                Upon entering the flat, you are greeted by a bright and welcoming foyer that leads to a spacious living room, featuring large windows that offer plenty of natural light. The living room flows seamlessly into the dining area, which is perfect for hosting dinner parties and entertaining guests.
                                                
                                                The fully equipped kitchen is modern and stylish, with high-end appliances, beautiful countertops, and plenty of storage space for all your cooking needs. The flat also features two generously sized bedrooms, each with ample closet space and large windows that offer beautiful views of the surrounding neighborhood.
                                                
                                                The master bedroom is a true retreat, with a spacious en-suite bathroom featuring a large soaking tub, walk-in shower, and double vanity. The other bedroom shares a well-appointed bathroom, complete with a bathtub and shower.
                                                
                                                The flat also boasts a lovely balcony, perfect for enjoying your morning coffee or relaxing in the evening. The building features a 24-hour concierge service, providing a safe and secure living environment for all residents.
                                                
                                                Located in a sought-after residential area, this flat is just minutes away from great restaurants, cafes, and shopping centers, as well as public transportation, making it the perfect location for those who want to enjoy all the conveniences of city living.
                                                
                                                With its modern amenities, stylish interior, and convenient location, this flat is the perfect place to call home. Contact us today to schedule a viewing!";
                                                }
    ?>
                                            </div>

                                            <h5 class="mt-5 mb-4 text-secondary double-down-line-left position-relative">Contact
                                                Agent</h5>
                                            <div class="agent-contact pt-60">
                                                <div class="row">

                                                    <div class="col-sm-8 col-lg-9">
                                                        <div class="agent-data text-ordinary mt-sm-20">
                                                            <h6 class=" text-capitalize"><?php echo "Name: " . $row['18']; ?>
                                                            </h6>
                                                            <ul class="mb-3">
                                                                <li><?php echo "Contact: " . $row['19']; ?></li>
                                                                <!--  -->
                                                                                                                                                                                                                        </ul>
                                                        <form method = "post">
                                                        <input type="submit" name="buy" class="btn btn-dark text-white col-lg-8" value = <?php echo "$btn_msg"; ?> <?php echo $btn_css?>></input>
                                            </form>
                                                        
                                                                                                                                                                    

                                                                                                                                                                    <div class="mt-3 text-secondary hover-text-primary">
                                                                                                                                                                        <ul>
                                                                                                                                                                            <li class="float-left mr-3"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                                                                                                                                            <li class="float-left mr-3"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                                                                                                                                            <li class="float-left mr-3"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                                                                                                                                                            <li class="float-left mr-3"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                                                                                                                                            <li class="float-left mr-3"><a href="#"><i class="fas fa-rss"></i></a></li>
                                                                                                                                                                        </ul>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                            <div class="col-md-12 col-lg-12">
                                                                                                                                                                <form class="bg-gray-form mt-5" action="#" method="post">
                                                                                                                                                                    <div class="row">
                                                                                                                                                                        <div class="col-md-5">
                                                                                                                                                                            <div class="row">
                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                    <div class="form-group">
                                                                                                                                                                                        <input class="form-control bg-gray" id="name" name="firstname" placeholder="Name" type="text">
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                    <div class="form-group">
                                                                                                                                                                                        <input class="form-control bg-gray" id="email" name="email" placeholder="Email" type="text">
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                    <div class="form-group">
                                                                                                                                                                                        <input class="form-control bg-gray" id="phone" name="phone" placeholder="Phone" type="text">
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                    <button type="submit" id="send" value="submit" class="btn btn-dark text-white">Send Message</button>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="col-md-7">
                                                                                                                                                                            <div class="row">
                                                                                                                                                                                <div class="col-md-12 col-lg-12">
                                                                                                                                                                                    <div class="form-group">
                                                                                                                                                                                        <textarea class="form-control bg-gray mt-sm-20" id="massage" name="massage" cols="30" rows="7" placeholder="Message"></textarea>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </form>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>

                                <?php } ?>

                                <div class="col-lg-4">
                                    
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4">



                                <div class="sidebar-widget mt-5">
                                    <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Recent
                                        Property Add</h4>
                                    <ul class="property_list_widget">

                                        <?php
                                         $query = mysqli_query($con,"SELECT city FROM property where pid = '$_REQUEST[pid]' ");
                                         $city = mysqli_fetch_array($query);
$query = mysqli_query($con, "SELECT * FROM property  where city = '$city[0]' ORDER BY time DESC LIMIT 6");
while ($row = mysqli_fetch_array($query)) {
    ?>

                            <?php
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row[14]) . '"/>';
                              ?>
                                                                                                                                                    <li>
                                                                                                                                                        <h6 class="text-secondary hover-text-primary text-capitalize mt-2">
                                                                                                                                                            <a href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo $row['3']. " in ". $row['6'] ?></a>
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
            <?php include("include/footer.php"); ?>
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