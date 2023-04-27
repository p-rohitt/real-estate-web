<?php

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include 'config.php';

$agent_id = $_SESSION['agent_id'];

$sql = "SELECT * FROM agent where agent_id = '$agent_id'";

$query = mysqli_query($con, $sql);

$row = mysqli_fetch_array($query);

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
        <h4 class="card-title text-center" style="font-family: Helvetica, sans-serif; color:black">Welcome, <?php echo $row[2]; ?>! </h4>
        <p class="card-text mt-4">
            Welcome to Bongora Tehsildar, and congratulations on joining our team of real estate professionals. We are thrilled to have you onboard, and we look forward to working with you to provide our clients with exceptional service and expertise in the real estate market.<br>

            At Bongora Tehsildar, we pride ourselves on being a client-focused company, dedicated to helping our clients achieve their real estate goals. As an agent on our team, you will have access to the latest tools and resources, as well as ongoing training and support to help you succeed.<br>
            
            We believe that our success as a company depends on the success of our agents, and we are committed to providing you with the support and guidance you need to build a successful career in real estate.<br>
            
            Once again, welcome to the team, and we look forward to working with you.
        </p>
      </div>
    </div>
  </div>




  <div class="container d-flex dtr-inline text-center">
    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://www.crescent-builders.com/blog/wp-content/uploads/2021/07/Handshake-over-Property-Deal.original-e1619002308793.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">SOLD</h5>
        <p class="card-text"> View all your properties sold.</p>
        <a href="agentpropertiessold.php" class="btn text-white rounded-lg " style = "background-color:black">Show</a>
      </div>
    </div>

    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://assets-news.housing.com/news/wp-content/uploads/2018/11/09093208/Real-estate-basics-What-is-a-Freehold-property-FB-1200x700-compressed.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title mt-3">Listed</h5>
        <p class="card-text"> Properties currently on the market</p>
        <a href="agentlistedproperties.php" class="btn text-white rounded-lg mt-1" style = "background-color:black">Show</a>
      </div>
    </div>

    <div class="card mt-5 ml-5" style="width: 18rem;">
      <img class="card-img-top" src="https://media.istockphoto.com/id/1291742526/vector/user-profile-icon-set-avatar-user-sign-person-man-icon-vector-eps-10-isolated-on-white.jpg?s=612x612&w=0&k=20&c=7DyLpTHG3CCyaCaZHfHmsInLUqa_HlnaOHbxCMNhRXs=" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Profile</h5>
        <p class="card-text"> Make changes to your profile</p>
        <a href="profile.php" class="btn rounded-lg text-white" style = "background-color:black;">Edit</a>
      </div>
    </div>
</div>


    <div class="container rounded mt-5" style="width: 990px; margin-left: 215px">

        <div class="card text-left">
          <img class="card-img-top" src="holder.js/100px180/" alt="">
          <div class="card-body">
            <h4 class="card-title text-center" style="font-family: Helvetica, sans-serif; color:black">Statistics  </h4>
            <p class="card-text mt-4">
                <?php 
                $query = mysqli_query($con,"SELECT property.*,record.* from record,property where record.agent_id = '$agent_id' and record.pid = property.pid order by property.price desc limit 1");
                $row2 = mysqli_fetch_array($query);

                ?>

                <h3 class = "card-title text-center"> Most Expensive Property Sold: </h3>
                
                    <table class="items-list col-lg-12" style="border-collapse:inherit;">
                        <thead>
                             <tr  class="bg-dark">
                                <th class = "text-white font-weight-bolder"></th>
                                <th class="text-white font-weight-bolder">Properties</th>
                                <th class="text-white font-weight-bolder">BHK</th>
                                <th class="text-white font-weight-bolder">Location</th>
                                <th class="text-white font-weight-bolder">Status</th>
								<th class="text-white font-weight-bolder">Time on Market</th>
                                
                             </tr>
                        </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row2[14]) . '"/>'; ?>
                                    </td>
                            <td>
                                
                                <div class="property-info d-table">
                                    <h5 class="text-secondary text-capitalize"><a href="propertydetail.php?pid=<?php echo $row['0'];?>"><?php echo $row2['3'];?></a></h5>
                                    <span class="font-14 text-capitalize"><i class="fas fa-map-marker-alt text-dark font-13"></i>&nbsp; <?php echo $row2['5'];?></span>
                                    <div class="price mt-3">
                                        <span class="text-dark">₹&nbsp;<?php echo $row2['4'];?></span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $row2['8'] . " bhk";?></td>
                            <td class="text-capitalize"> <?php echo $row2['6'] .", ". $row2['7'];?></td>
                            <td><?php echo $row2[11];?></td>
                            <td class="text-capitalize"><?php
                            $sqlquery = "SELECT ROUND(DATEDIFF(NOW(),'$row2[12]')/365,1)";
                            $sq = mysqli_query($con, $sqlquery);
                            $row2 = mysqli_fetch_array($sq);
                            echo $row2[0] . " years";
                                ?>
                            </td>
                            
                        </tr>
                    </tbody> 
                </table>

                <h3 class = " card-title text-center mt-4"> Total revenue generated: </h3>
                <?php
                $query = mysqli_query($con,"SELECT sum(price) from record where record.agent_id = '$agent_id'");

                $row = mysqli_fetch_array($query);

                ?>
                <p class = "card-body text-center mark font-weight-bolder"><?php echo "₹".$row[0]; ?> </p>

                <h3 class = " card-title text-center mt-4"> Sellers linked to you: </h3>
                


                <table class="items-list col-lg-12" style="border-collapse:inherit;">
                    <thead>
                         <tr  class="bg-dark">
                            
                            <th class="text-white font-weight-bolder">Name</th>
                            <th class="text-white font-weight-bolder">Contact</th>
                            
                            
                         </tr>
                    </thead>
                <tbody>
                    <?php
                $query = mysqli_query($con,"SELECT seller.* from seller where seller.agent_id = '$agent_id'");

                while($row = mysqli_fetch_array($query)){

                ?>
                    <tr>
                        <td><?php echo $row[4];?></td>
                        <td class="text-capitalize"> <?php echo $row[2];?></td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>


            <h3 class = " card-title text-center mt-4"> Buyers:  </h3>
          


            <table class="items-list col-lg-12" style="border-collapse:inherit;">
                <thead>
                     <tr  class="bg-dark">
                        
                        <th class="text-white font-weight-bolder">Name</th>
                        <th class="text-white font-weight-bolder">Contact</th>
                        <th class = "text-white font-weight-bolder">Phone</th>
                        
                     </tr>
                </thead>
            <tbody>
                <?php
                $query = mysqli_query($con,"SELECT user.* from user where user.agent_id = '$agent_id'");

                while($row = mysqli_fetch_array($query)){

                ?>
                <tr>
                    <td><?php echo $row[1];?></td>
                    <td class="text-capitalize"> <?php echo $row[2];?></td>
                    <td class = "text-capitalize"> <?php echo $row[4]; ?></td>
                </tr>
                <?php } ?>
            </tbody> 
        </table>


            
          </div>
        </div>
    </div>





</body>

</html>