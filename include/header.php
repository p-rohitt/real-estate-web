<header id="header" class="transparent-header-modern fixed-header-bg-white w-100">
   
    <div class="main-nav secondary-nav hover-primary-nav py-1 text-white" style = "background-color:black">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0"> <a class="navbar-brand position-relative"
                            href="#"><img class="nav-logo" src="images/logos/logo.png" alt="cant"/></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"> <span
                                class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown"> <a class="nav-link text-white" href="temp.php"
                                        role="button" aria-haspopup="true" aria-expanded="false">Home</a></li>

                                <!-- <li class="nav-item"> <a class="nav-link text-muted" href="about.php">About</a></li> -->

                                <li class="nav-item"> <a class="nav-link text-white" href="agentlogin.php">Agent</a> </li>
                                <li class="nav-item"> <a class="nav-link text-white" href="sellerlogin.php">Seller</a> </li>

                                <li class="nav-item"> <a class="nav-link text-white" href="property.php">Properties</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link text-white" href="contact.php">Contact</a>
                                </li>

                                <?php if (isset($_SESSION['uemail'])) { ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">My Account</a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item text-black"> <a class="nav-link" href="profile.php">Profile</a> </li>
                                                
                                                <li class="nav-item"> <a class="nav-link" href="feature.php">Your Property</a>
                                                </li>
                                                <li class="nav-item"> <a class="nav-link" href="logout.php">Logout</a> </li>
                                            </ul>
                                        </li>
                                <?php } else { ?>
                                        <li class="nav-item"> <a class="nav-link text-muted" href="login.php">Login/Register</a>
                                        </li>
                                <?php } ?>

                            </ul>


                            <!-- <a class="btn btn-primary d-none d-xl-block" href="submitproperty.php">Submit Peoperty</a> -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>