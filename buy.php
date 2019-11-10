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
       $add= $db->post($name, $sum, $select, $image);
       if ($add['status']) {
          $qty_left=$qty-$select;
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

/*
const quantity = this.value;
let total = price* quantity;
console.log(quantity);
Document.getElementbyId('qty').innerText = total;
var yourSelect = document.getElementById( "your-select-id" );
alert( yourSelect.options[ yourSelect.selectedIndex ].value )
*/
console.log(price)
const quantity=document.getElementById('qty');

console.log(quantity.options[quantity.selectedIndex].value)
let qty=quantity.options[quantity.selectedIndex].value;
let total=price*qty;
let sum= `Total :  ${total} $ `;
console.log(total)
document.getElementById('display').innerText = sum;

}
</script>



<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>buy</title>
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
         <span class="text-left mt-2"><h4> <?php
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
            echo '<div class="alert alert-danger text-center" role="alert">'.'sorry item out of stock click on home and try another item'.'</div>'; 
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
         <form method="post" action="buy.php">
           <div class="form-group">
            <select class="" name="amount" id="qty" onchange="calculateTotal(price)">
            <option value="">select quantity</option>;
            
            <?php
            for ($i=1; $i<=$qty; $i++) {
               echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
           </select>
           <h5><p class="mt-2 mb-3" id="display"> </p></h5>
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
    