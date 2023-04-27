<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");
if (!isset($_SESSION['seller_id'])) {
	header("location:sellerlogin.php");
}

//// code insert
//// add code
$error = "";
$msg = "";


$seller_id = $_SESSION['seller_id'];
$sql = "SELECT agent.* from agent,seller where seller.seller_id = '$seller_id' and seller.agent_id = agent.agent_id";
$q = mysqli_query($con,$sql);
$agentdata = mysqli_fetch_array($q);



if (isset($_POST['add'])) {

	$type = $_POST['type'];
	$bhk = $_POST['bhk'];
	$sale_type = $_POST['sale_type'];
	$price = $_POST['price'];
	$city = $_POST['city'];
	$size = $_POST['size'];
	$state = $_POST['state'];
	$status = $_POST['status'];
	$address = $_POST['address'];
	$time = date("Y-m-d");

	$aimage = $_FILES['aimage']['name'];
	$aimage1 = $_FILES['aimage1']['name'];

	$temp_name = $_FILES['aimage']['tmp_name'];
	$temp_name1 = $_FILES['aimage1']['tmp_name'];

	move_uploaded_file($temp_name, "admin/property/$aimage");
	move_uploaded_file($temp_name1, "admin/property/$aimage1");
	

	
	$sql = "insert into property (seller_id,agent_id,type,price,address,city,state,bhk,size,status,sale_type,time)
	values('$seller_id','$agentdata[0]','$type','$price','$address','$city','$state','$bhk','$size','$status',
	'$sale_type','$time')";
	$result = mysqli_query($con, $sql);
	if ($result) {
		$msg = "<p class='alert alert-success'>Property inserted successfully!</p>";
		$sql = "select pid from property order by pid desc limit 1";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($query);
		$output = shell_exec("python addphoto.py $aimage $aimage1 $row[0]");
		if($output == 0){
			$error = "<p class = 'alert alert-warning'> Error while uploading image </p>";
		}

	} else {
		$error = "<p class='alert alert-warning'>Property Not Inserted, Some Error!</p>";
	}
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
	<link rel="stylesheet" type="text/css" href="css/color.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">

	<!--	Title
	=========================================================-->
	<title>Homex - Real Estate Template</title>
</head>

<body>

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
							<h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Submit Property</b>
							</h2>
						</div>
						<div class="col-md-6">
							<nav aria-label="breadcrumb" class="float-left float-md-right">
								<ol class="breadcrumb bg-transparent m-0 p-0">
									<li class="breadcrumb-item text-white"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Submit Property</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!--	Banner   --->


			<!--	Submit property   -->
			<div class="full-row">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h2 class="text-secondary double-down-line text-center">Submit Property</h2>
						</div>
					</div>
					<div class="row p-5 bg-white">
						<form method="post" enctype="multipart/form-data">
							<div class="description">
								<h5 class="text-secondary">Basic Information</h5>
								<hr>
								<?php echo $error; ?>
								<?php echo $msg; ?>

								<div class="row">
									<!-- <div class="col-xl-12">
										<div class="form-group row">
											<label class="col-lg-2 col-form-label">Title</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="title" required
													placeholder="Enter Title">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-2 col-form-label">Content</label>
											<div class="col-lg-9">
												<textarea class="tinymce form-control" name="content" rows="10"
													cols="30"></textarea>
											</div>
										</div>

									</div> -->
									<div class="col-xl-6">
										<div class="form-group row">
											<label class="col-lg-3 col-form-label"><b>Property Type</b></label>
											<div class="col-lg-9">
												<select class="form-control" required name="type">
													<option value="">Select Type</option>
													<option value="Apartment">Apartment</option>
													<option value="Flat">Flat</option>
													<option value="House">House</option>
													<option value="Villa">Villa</option>
													<option value="Office">Office</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label"><b>Selling Type</b></label>
											<div class="col-lg-9">
												<select class="form-control" required name="sale_type">
													<option value="">Select Status</option>
													<option value="Rent">Rent</option>
													<option value="Sale">Sale</option>
												</select>
											</div>
										</div>
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Bathroom</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="bath" required
													placeholder="Enter Bathroom (only no 1 to 10)">
											</div>
										</div> -->
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Kitchen</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="kitc" required
													placeholder="Enter Kitchen (only no 1 to 10)">
											</div>
										</div> -->

									</div>
									<div class="col-xl-6">
										<div class="form-group row mb-3">
											<label class="col-lg-3 col-form-label"><b>BHK</b></label>
											<div class="col-lg-9">
												<input class="form-control" required name="bhk" type = 'number' placeholder = "BHK"/>
													<!-- <option value="">Select BHK</option>
													<option value="1">1 BHK</option>
													<option value="2">2 BHK</option>
													<option value="3">3 BHK</option>
													<option value="4">4 BHK</option>
													<option value="5">5 BHK</option>
												</input> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label mt-4 "><b>Bedroom</b></label>
											<div class="col-lg-9 mt-4">
												<input type="text" class="form-control" name="bed" required
													placeholder="Enter Bedroom  (only no 1 to 10)">
											</div>
										</div>
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Balcony</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="balc" required
													placeholder="Enter Balcony  (only no 1 to 10)">
											</div>
										</div> -->
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Hall</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="hall" required
													placeholder="Enter Hall  (only no 1 to 10)">
											</div>
										</div> -->

									</div>
								</div>
								<h5 class="text-secondary">Price & Location</h5>
								<hr>
								<div class="row">
									<div class="col-xl-6">
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Floor</label>
											<div class="col-lg-9">
												<select class="form-control" required name="floor">
													<option value="">Select Floor</option>
													<option value="1st Floor">1st Floor</option>
													<option value="2nd Floor">2nd Floor</option>
													<option value="3rd Floor">3rd Floor</option>
													<option value="4th Floor">4th Floor</option>
													<option value="5th Floor">5th Floor</option>
												</select>
											</div>
										</div> -->
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Price</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="price" required
													placeholder="Enter Price">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">City</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="city" required
													placeholder="Enter City">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">State</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="state" required
													placeholder="Enter State">
											</div>
										</div>
									</div>
									<div class="col-xl-6">
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Total Floor</label>
											<div class="col-lg-9">
												<select class="form-control" required name="totalfl">
													<option value="">Select Floor</option>
													<option value="1 Floor">1 Floor</option>
													<option value="2 Floor">2 Floor</option>
													<option value="3 Floor">3 Floor</option>
													<option value="4 Floor">4 Floor</option>
													<option value="5 Floor">5 Floor</option>
													<option value="6 Floor">6 Floor</option>
													<option value="7 Floor">7 Floor</option>
													<option value="8 Floor">8 Floor</option>
													<option value="9 Floor">9 Floor</option>
													<option value="10 Floor">10 Floor</option>
													<option value="11 Floor">11 Floor</option>
													<option value="12 Floor">12 Floor</option>
													<option value="13 Floor">13 Floor</option>
													<option value="14 Floor">14 Floor</option>
													<option value="15 Floor">15 Floor</option>
												</select>
											</div>
										</div> -->
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Area Size</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="size" required
													placeholder="Enter Area Size (in sqft)">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Address</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="address" required
													placeholder="Enter Address">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Status</label>
											<div class="col-lg-9">
												<select class="form-control" required name="status">
													<option value="">Select Status</option>
													<option value="Available">Available</option>
													<option value="Sold">Sold Out</option>
													<option value = "Rented">Rented</option>
												</select>
											</div>
										</div>

									</div>
								</div>

								<!-- <div class="form-group row">
									<label class="col-lg-2 col-form-label">Feature</label>
									<div class="col-lg-9">
										<p class="alert alert-danger">* Important Please Do Not Remove Below Content
											Only Change <b>Yes</b> Or <b>No</b> or Details and Do Not Add More Details
										</p>

										<textarea class="tinymce form-control" name="feature" rows="10" cols="30">
												-feature area start-
												<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Property Age : </span>10 Years</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Swiming Pool : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Parking : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">GYM : </span>Yes</li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Type : </span>Appartment</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Security : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Dining Capacity : </span>10 People</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Temple  : </span>Yes</li>
														
														</ul>
													</div>
													<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">3rd Party : </span>No</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Alivator : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">CCTV : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Water Supply : </span>Ground Water / Tank</li>
														</ul>
													</div>
												-feature area end--
											</textarea>
									</div>
								</div> -->

								<h5 class="text-secondary">Image & Status</h5>
								<hr>
								<div class="row">
									<div class="col-xl-6">

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Image 1</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage" type="file" required="">
											</div>
										</div>
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Image 2</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage2" type="file" required="">
											</div>
										</div> -->
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">Image 4</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage4" type="file" required="">
											</div>
										</div> -->
										

									</div>
									<div class="col-xl-6">

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Image 2</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage1" type="file" required="">
											</div>
										</div>
										<!-- <div class="form-group row">
											<label class="col-lg-3 col-form-label">image 3</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage3" type="file" required="">
											</div>
										</div> -->
									</div>
								</div>


								<input type="submit" value="Submit" class="btn text-white" style = "background-color:black; margin-left:380px;margin-top:50px;width:200px;" name="add"
									style="margin-left:200px;">

							</div>
						</form>
					</div>
				</div>
			</div>
			<!--	Submit property   -->


			<!--	Footer   start-->
			<?php include("include/footer.php"); ?>
			<!--	Footer   start-->

			<!-- Scroll to top -->
			<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i
					class="fas fa-angle-up"></i></a>
			<!-- End Scroll To top -->
		</div>
	</div>
	<!-- Wrapper End -->

	<!--	Js Link
============================================================-->
	<script src="js/jquery.min.js"></script>
	<script src="js/tinymce/tinymce.min.js"></script>
	<script src="js/tinymce/init-tinymce.min.js"></script>
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