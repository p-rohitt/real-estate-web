<?php

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include 'config.php';

$seller_id = $_SESSION['seller_id'];

$sql = "SELECT * FROM seller where seller_id = '$seller_id'";

$query = mysqli_query($con, $sql);

$row = mysqli_fetch_array($query);

$sql = "SELECT agent.* FROM agent,seller where seller.seller_id = '$seller_id' and seller.agent_id = agent.agent_id ";
$query = mysqli_query($con,$sql);

$agentdata = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Meta Tags -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="shortcut icon" href="images/favicon.ico" />

  <!--	Fonts
    ========================================================-->
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet" />

  <!--	Css Link
    ========================================================-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="css/layerslider.css" />
  <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change" />
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <!--	Title
    =========================================================-->
  <title>Bongora Tehsildar</title>

  <style>

  </style>
</head>

<body>

  <?php include 'include/header.php'; ?>

  <div class="container rounded mt-5" style="width: 990px; margin-left: 215px">

    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title text-center" style="font-family: Helvetica, sans-serif; color:black">Welcome, <?php echo $row[4]; ?>! </h4>
        <p class="card-text mt-4">
          As a seller, you'll benefit from our user-friendly interface that makes it easy to list your property and showcase its features. You can also create a personalized profile to manage your listings, track your leads, and stay up-to-date on the latest market trends.
          <br><br>
          Our platform also provides valuable resources for sellers, including tips on how to stage your property for maximum appeal, advice on setting the right price, and guidance on navigating the selling process. Plus, you'll have access to a network of experienced real estate professionals who can provide expert support and advice throughout the process.
          <br><br>
          Whether you're looking to sell your home, apartment, or commercial property, our Real Estate platform is the perfect place to connect with potential buyers and make your sale a success. Start selling today!
        </p>
      </div>
    </div>
  </div>




  <div class="container d-flex dtr-inline text-center">
    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://www.crescent-builders.com/blog/wp-content/uploads/2021/07/Handshake-over-Property-Deal.original-e1619002308793.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">View</h5>
        <p class="card-text"> View all your properties listed.</p>
        <a href="sellerlistedproperties.php" class="btn text-white rounded-lg " style = "background-color:black">Show</a>
      </div>
    </div>

    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://assets-news.housing.com/news/wp-content/uploads/2018/11/09093208/Real-estate-basics-What-is-a-Freehold-property-FB-1200x700-compressed.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title mt-3">List</h5>
        <p class="card-text"> Add a new property to sell</p>
        <a href="submitproperty.php" class="btn text-white rounded-lg mt-1" style = "background-color:black">Add</a>
      </div>
    </div>

    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://media.istockphoto.com/id/1291742526/vector/user-profile-icon-set-avatar-user-sign-person-man-icon-vector-eps-10-isolated-on-white.jpg?s=612x612&w=0&k=20&c=7DyLpTHG3CCyaCaZHfHmsInLUqa_HlnaOHbxCMNhRXs=" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Profile</h5>
        <p class="card-text"> Make changes to your profile</p>
        <a href="profile.php" class="btn text-white rounded-lg" style = "background-color:black">Edit</a>
      </div>
    </div>



  </div>

  <div class="container rounded mt-5" style="width: 990px; margin-left: 215px">

    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title text-center" style="font-family: Helvetica, sans-serif; color:black">Agent</h4>
        <br class="card-text mt-4">
          A real estate agent is a licensed professional who helps clients buy, sell, and rent properties such as homes, commercial buildings, and land. Their main responsibilities include:<br>

  <b>Listing properties for sale or rent:</b> Real estate agents help clients prepare their property for sale or rent, and then list it on multiple listing services (MLS) or other platforms to find potential buyers or renters.<br>

<b>Finding properties for buyers or renters:</b> Real estate agents work with clients to identify their needs and preferences, and then search for properties that match those requirements.<br>

<b>Conducting property showings:</b> Real estate agents arrange property showings for potential buyers or renters and guide them through the property, answering any questions they may have.<br>

<b>Negotiating contracts:</b> Real estate agents help clients negotiate contracts for the sale or rental of a property, ensuring that all terms are fair and agreeable to both parties.<br>

<b>Providing market analysis:</b> Real estate agents provide clients with up-to-date information on the real estate market, including comparable properties and trends that may impact the sale or rental of a property.<br>

<b>Managing paperwork: </b>Real estate agents are responsible for managing all the paperwork associated with the purchase, sale, or rental of a property, including contracts, deeds, and financial statements.
<br><br>


          <h4> Your Agent's Details </h4>
          <p> <b>Name :</b>  <?php echo $agentdata[2]; ?></p>
          <p> <b>Contact:</b>  <?php echo $agentdata[3] ; ?></p>
          
        </p>
      </div>
    </div>
  </div>






</body>

</html>