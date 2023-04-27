<?php

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include 'config.php';

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
        <h4 class="card-title text-center" style="font-family: Helvetica, sans-serif; color:black">Welcome, Admin! </h4>
        <p class="card-text mt-4">
        You have successfully logged into the admin dashboard of Bongora Tehsildar. As an administrator, you have access to powerful tools and features that will allow you to manage and control the website or application.<br>

        From this dashboard, you can manage users, edit and delete content, view website statistics, and configure settings. If you need any help or support, our team is available to assist you.<br>

        Thank you for choosing Bongora Tehsildar and we hope you have a great experience managing your website or application!"
        </p>
      </div>
    </div>
  </div>




  <div class="container d-flex dtr-inline text-center">
    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://www.crescent-builders.com/blog/wp-content/uploads/2021/07/Handshake-over-Property-Deal.original-e1619002308793.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">AGENTS</h5>
        <p class="card-text"> View all your agent's reports.</p>
        <a href="adminagents.php" class="btn text-white rounded-lg " style = "background-color:black">Show</a>
      </div>
    </div>

    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://assets-news.housing.com/news/wp-content/uploads/2018/11/09093208/Real-estate-basics-What-is-a-Freehold-property-FB-1200x700-compressed.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title mt-3">SELLERS</h5>
        <p class="card-text"> Show all sellers </p>
        <a href="adminsellers.php" class="btn text-white rounded-lg mt-1" style = "background-color:black">Show</a>
      </div>
    </div>

    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://media.istockphoto.com/id/1291742526/vector/user-profile-icon-set-avatar-user-sign-person-man-icon-vector-eps-10-isolated-on-white.jpg?s=612x612&w=0&k=20&c=7DyLpTHG3CCyaCaZHfHmsInLUqa_HlnaOHbxCMNhRXs=" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Users</h5>
        <p class="card-text"> Show all users</p>
        <a href="adminusers.php" class="btn rounded-lg text-white" style = "background-color:black;">Show</a>
      </div>
    </div>
</div>








</body>

</html>