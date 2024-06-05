<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

$bid =  $_SESSION['bid'];

require_once 'db.php';

$sql1="select * from vehicle_details where vname = (select name from vehicle_list where Reg_no = (select reg_no from booking where bid = '$bid'));";
$vehicle = $con->query($sql1);
$sql2="select * from vehicle_list where Reg_no = (select reg_no from booking where bid = '$bid')";
$cost = $con->query($sql2);
$sql3="select * from price where bid = '$bid';";
$prc = $con->query($sql3);
$sql4="select * from shipping where bid = '$bid';";
$ad1 = $con->query($sql4);
$sql5="select * from billing where bid = '$bid';";
$ad2 = $con->query($sql5);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Receipt</title>
  <link rel="stylesheet" href="receipt1.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- about -->
<div class="about">
   <a class="bg_links social portfolio" href="https://www.facebook.com/" target="_blank">
      <span class="icon"></span>
   </a>
   <a class="bg_links social dribbble" href="https://www.instagram.com/" target="_blank">
      <span class="icon"></span>
   </a>
   <a class="bg_links social linkedin" href="https://www.linkedin.com/in/rafaelalucas/" target="_blank">
      <span class="icon"></span>
   </a>
   <a class="bg_links logo"></a>
</div>
<!-- end about -->
<div class="wrapper">
   <div class="container">
      <p class="thanks"> Thank you for your order!</p>

      <button class="cta"> print receipt</button>
      <div class="receipt">
         <div class="receipt__message">
            <h2 class="receipt__title">Thank you for your order!</h2>
            <p class="receipt__text">
               Your order <strong>#<?php echo $bid?> </strong> has been successfully registered.
               Please check all the data so that everything is correct!
            </p>
            <a href="profile.php" class="btn">view order</a>
         </div>

         <?php
         while($row1 = mysqli_fetch_assoc($vehicle)){
         ?>
         <div class="product">
            <figure class="product__image">
               <img src="<?php echo $row1["image"];?>" alt="">
            </figure>
            <div>
               <h3 class="product__name"><?php echo $row1["vname"];?></h3>
               <?php 
               while($row2 = mysqli_fetch_assoc($cost)){
               ?>
               <p class="product__Price">
               &#8377 <?php echo $row2["price"];?>/Hr
               </p>
               <?php } ?>
            </div>

         </div>
         <?php }?>
         <div class="price">
            <?php 
            while($row3 = mysqli_fetch_assoc($prc)){
               ?>
            <div class="price__pricing">
               <p class="DAYS">
                  TOTAL TIME OF RENTING
               </p>
               <p class="TIME">
                 <?php echo $row3["duration"];?> Hours
               </p>
            </div>
            <div class="price__pricing">
               <p class="price__princingTitle">
                  Subtotal
               </p>
               <p class="price__princingNumber">
               &#8377 <?php echo $row3["subtotal"];?>
               </p>

            </div>
            <div class="price__pricing">
               <p class="price__princingTitle">
                  Damage Protection Package
               </p>
               <p class="price__princingNumber">
               &#8377 <?php echo $row3["damage"];?>
               </p>

            </div>

            <div class="price__pricing">
               <p class="price__princingTitle">
                  discount
               </p>
               <p class="price__princingNumber">
               &#8377 <?php echo $row3["discount"];?>
               </p>

            </div>


             
            <div class="price__pricing">
               <p class="price__princingTitle">
                  TAX(18%)
               </p>
               <p class="price__princingNumber">
               &#8377 <?php echo $row3["tax"];?>
               </p>

            </div>


            <div class="price__total">
               <p class="price__total">
                  Total
               </p>
               <p class="price__total">
               &#8377 <?php echo $row3["total"];?>
               </p>
            </div>
         </div>
         <?php } ?>

         <div class="info">
            <h4 class="info__infoTitle">Customer Data</h4>

            <div class="info__addressContent">
            <?php 
            while($row4 = mysqli_fetch_assoc($ad1)){
               ?>
               <div class="info__address">
                  <h5 class="info__addressTitle">Shipping Address</h5>
                  <p class="info__addressText">
                   <?php echo $row4["name"];?> <br>
                     Address — <?php echo $row4["add1"];?> <?php echo $row4["add2"];?><br> 
                     <?php echo $row4["city"];?> <br>
                     <?php echo $row4["province"];?> <?php echo $row4["pincode"];?> <br>
                     <?php echo $row4["state"];?> <br>
                  </p>

               </div>
               <?php } ?>
            <?php 
            while($row5 = mysqli_fetch_assoc($ad2)){
               ?>
               <div class="info__address">
                  <h5 class="info__addressTitle">Billing Address</h5>
                  <p class="receipt__addressText">
                  <?php echo $row5["name"];?> <br>
                     Home Add— <?php echo $row5["add1"];?> <?php echo $row5["add2"];?><br>
                     <?php echo $row5["city"];?> <br>
                     <?php echo $row5["province"];?> <?php echo $row5["pincode"];?> <br>
                     <?php echo $row5["state"];?> <br>
                  </p>
               </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- partial -->
  <script  src="receipt.js"></script>

</body>
</html>
