<?php
if(session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();

    include "lib/DBconnection.php";
    $db = new DBconnection();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>order</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- boostrap
    ================================================== -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     </header>
     <body>
     <section>
     <div class="" style="background-color:black!important;">
         <span class="text-left mt-2"><h4><?php
                    
                    if (isset($_SESSION['username'])) 
                        echo "welcome ". $_SESSION['username']." ";
                        ?><h4><h4></span>
         <h1 class=" text-white text-center"style="margin:auto!important;">COMPUTER STORE</h1>
       
       </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-dark text-center" style="background-color:black!important;">
              
             <ul class="nav justify-content-center" style="margin:auto!important">
                <li class="nav-item">
                    <a class="nav-link text-white" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                   <a class=" nav-link text-white" href="order.php">Order List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                </li>
                
              </ul>
         
       </nav>
    </section>
    <body>
      <section>
         <div class="container-fluid">
            <div class="row">
              <div class="col-12 text-center mt-3 mb-2 font-weight-bold"><h3>PURCHASED PRODUCT LIST</h4></div>
               <div class="col-4 font-weight-bold mt-2">IMAGE</div>
               <div class="col-2 font-weight-bold mt-2">PRODUCT NAME</div>
               <div class="col-2 font-weight-bold mt-2">COST</div>
               <div class="col-2 font-weight-bold mt-2">QUANTITY</div>
               <div class="col-2 font-weight-bold mt-2">ACTION</div>
               
            </div>
            <div class="row">
            <div class="col-12 text-center mt-3 mb-2 font-weight-bold"><h3>RENTED PRODUCT LIST</h4></div>
            <div class="col-4 font-weight-bold mt-2">IMAGE</div>
               <div class="col-2 font-weight-bold mt-2">PRODUCT NAME</div>
               <div class="col-2 font-weight-bold mt-2">COST</div>
               <div class="col-2 font-weight-bold mt-2">QUANTITY</div>
               <div class="col-2 font-weight-bold mt-2">ACTION</div>
            </div>
         </div>
      </section>
    </body>
    </html>
