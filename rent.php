
<?php
if(session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
    include "lib/DBconnection.php";
    if (isset($_POST['hiddenID'])){
        $id = $_POST['hiddenID'];
    }
    else{
        $id= $_GET["id"];}

    $db = new DBconnection();
		//echo "$id";
    $query="SELECT * FROM product WHERE p_id='$id'";
    $post = $db->select($query);
     $qty=0;

     foreach($post as $result)
     {
         $name=$result['pname'];
         $price=$result['price'];
         $qty=$result['quantity'];
         $image=addslashes($result['image']);

     }
     if (isset($_POST['pay'])) {
        if($qty<1){
         echo "";
        }else{
       $select=$_POST['amount'];
      //echo $select;
      $sum=$price*$select;
      $add= $db->post2($name, $sum, $select, $image);
      if ($add['status']) {
         $qty_left=$qty-1;
         $sql = "UPDATE product SET quantity=$qty_left WHERE p_id=$id";
         $update=$db->update($sql);
      }
   }
  
   }
    
    if ($post) {
                $result = $post;
		
    } elseif ($post['status'] == FALSE) {
        echo $post['message'];
    }
    

?>
<script>

const price =<?php echo $price; ?>;
function calculateTotal(price)
{
const quantity=document.getElementById('duration');
let qty=quantity.options[quantity.selectedIndex].value;
let total=price*qty;
let sum= `Total :  ${total} $ `;
document.getElementById('show').innerText = sum;


}
</script>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>rent</title>
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
                        ?><h4></span>
                        
 <?php
 if (isset($_POST['pay'])) {
   if($qty>1){
        if ($add['status'] ) {
       
      echo '<div class="alert alert-success text-center" role="alert">'.$add['message'].'</div>';
        } 
    }
        else{
            echo '<div class="alert alert-danger text-center" role="alert">'.'Sorry to rent we must have more than 1 item in stock click on home and try another item'.'</div>'; 
        }    

 }
             ?>
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
    <section>
    <div class="container-fluid">
       <div class="row">
       <?php foreach ($result as $product) {?>
         <div class="col-6 my-3 pl-3">
         <?php echo '<img src="data:images/thumbs/detail/jpeg;base64,'.base64_encode( $product['image'] ).'"/>'?>;

         </div>
         <div class="col-6 my-3 ">
         <h1 class="text-primary text-bold"><?php echo $product['pname']; ?></h1>
         <p><h6>Description goes here</h6></p>
         <p><h5>  Price: <?php echo $product['price']; ?>$</h5></p>
         <form method="post" action="rent.php">
         <div class="form-group">
        
         <label for="sel1"><h5>you can only rent for a max of 7 days</h5></label><br>
         <select class="" name="amount" id="duration" onchange="calculateTotal(price)">
         <option>select duration</option>
         <option value="1">1 day</option>
         <option value="2">2 day</option>
         <option value="3">3 day</option>
         <option value="4">4 day</option>
         <option value="5">5 day</option>
         <option value="6">6 day</option>
         <option value="7">7 day</option>
         </select>
         <h5> <p class="mt-4 mb-2" id="show"></p></h5>
         <input type="hidden" name="hiddenID" value="<?php echo $id; ?>" />
         <input type="submit" name="pay" value="Add to order list" class="btn btn-primary"/>
         

         </div>
         </form>
         </div>
         <?php } ?>
      </div>
    </div>
    </section>

     </body>
     </html>
    