<?php
    include "lib/DBconnection.php";
    $db = new DBconnection();
		//for displaying products
		$query = "select * from product";
    
    $post = $db->select($query);
    if ($post) {
				$result = $post;
		
    } elseif ($post['status'] == FALSE) {
        echo $post['message'];
	}
	if (isset($_POST['search'])) {

		$res=$_POST['search'];
		$query= "select * from product  WHERE (`pname` LIKE '%".$res."%')";

		$results= $db->search($query);
		if ($results) {
			$result = $results;
			
		} elseif ($results['status'] == FALSE) {
			echo $results['message'];
		}
    }
    if (isset($_POST['buy'])) {
        echo "<script>alert(' you need to login to buy')</script>";
    }
    if (isset($_POST['rent'])) {
        echo "<script>alert(' You need to login to rent')</script>";
        
    }


		//<?php echo $product['image'];


?>




<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Computer store</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
   

</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    <section class="s-pageheader s-pageheader--home">

        <header class="header">
            <div class="header__content row">
           
                <div class="header__logo text-white">
                   <h1  style="color:white;">COMPUTER STORE</h1>
                </div> <!-- end header__logo -->

                <ul class="header__social">
                    <li>
                        <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    </li>
                </ul> <!-- end header__social -->
 
                <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <form role="search" method="post" class="header__search-form" action="index.php">
                        <label>
                            <span class="hide-content">Search by computer name:</span>
                            <input type="search" class="search-field" placeholder="Enter title" value="" name="search" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>
        
                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

                </div>  <!-- end header__search -->


                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <li class="current"><a href="index.php" title="">Home</a></li>
                        
                        <li class="">
                            <a href="signup.php" title="">Sign Up</a>
                            
                        </li>
                        <li><a href="login.php" title="">Login</a></li>
                       
                    </ul> <!-- end header__nav -->

                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                </nav> <!-- end header__nav-wrap -->

            </div> <!-- header-content -->
        </header> <!-- header -->


        <div class="pageheader-content row">
            <div class="col-full">

       

                <div class="featured">

                    <div class="featured__column featured__column--big">
                        <div class="entry" style="background-image:url('images/thumbs/featured/car-rent.jpg');">
                            
                            <div class="entry__content">
                

                                <h1><a href="#0" title="">Great deal of any computer you can get any where.</a></h1>

                            </div> <!-- end entry__content -->
                            
                        </div> <!-- end entry -->
                    </div> <!-- end featured__big -->

                    <div class="featured__column featured__column--small">

                        <div class="entry" style="background-image:url('images/thumbs/featured/rent12.png');">
                            
                            <div class="entry__content">
                    

                                <h1><a href="#0" title="">You can get any computer you want.</a></h1>

                            </div> <!-- end entry__content -->
                          
                        </div> <!-- end entry -->

                        <div class="entry" style="background-image:url('images/thumbs/featured/rent13.png');">

                            <div class="entry__content">

                                <h1><a href="#0" title="">Get the best deal you can get.</a></h1>

                            </div> <!-- end entry__content -->

                        </div> <!-- end entry -->

                    </div> <!-- end featured__small -->
                </div> <!-- end featured -->

            </div> <!-- end col-full -->
        </div> <!-- end pageheader-content row -->

    </section> <!-- end s-pageheader -->


    <!-- s-content
    ================================================== -->
    <section class="s-content">
        
        <div class="row masonry-wrap">
            <div class="masonry">
            <?php foreach ($result as $product) {?>
                <div class="grid-sizer"></div>

                <article class="masonry__brick entry format-standard" data-aos="fade-up">
                        
                    <div class="entry__thumb">
                        
                        <?php echo '<img src="data:images/thumbs/detail/jpeg;base64,'.base64_encode( $product['image'] ).'"/>'?>;

                            <!-- <img src="images/thumbs/detail/<?php /*echo addslashes($product['image'])*/?>" alt="">-->
                        
                        
                    </div>
    
                    <div class="entry__text">
                        <div class="entry__header">
                            
                            <div class="entry__date">
                                <a href="single-standard.html">Quantity in stock: <?php echo $product['quantity']; ?></a>
                            </div>
                            <h1 class="entry__title"><?php echo $product['pname']; ?></h1>
                            
                        </div>
                        <div class="entry__excerpt">
                            <p>
                              Descrıptıon goes here
                            </p>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                            Price: <?php echo $product['price']; ?>$
                            </span>
                            
                        </div>
                        <form method="post" action="index.php">
                        <div class="entry__meta">
                            <span >
                            <input type="submit" name="buy" value="buy" style="background-color:#01579B; color:white"/>
         

        
                            
                            <button type="button" name="rent" class="" id="rent" style="background-color:#00C853; color:white">Rent</button></span>
                            
                        </div>
                        </form>
                    </div>
    
                </article> <!-- end article -->
                <?php } ?>

               

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        <li><a class="pgn__prev" href="#0">Prev</a></li>
                        <li><a class="pgn__num" href="#0">1</a></li>
                        <li><span class="pgn__num current">2</span></li>
                        <li><a class="pgn__num" href="#0">3</a></li>
                        <li><a class="pgn__num" href="#0">4</a></li>
                        <li><a class="pgn__num" href="#0">5</a></li>
                        <li><span class="pgn__num dots">…</span></li>
                        <li><a class="pgn__num" href="#0">8</a></li>
                        <li><a class="pgn__next" href="#0">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->


    <!-- s-extra
    ================================================== -->
            
    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>

</html>