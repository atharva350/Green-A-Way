<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");


require_once 'db.php';
  $location = $_SESSION['locationpass']; 
  $type = $_SESSION['typepass']; 
  $startdate = $_SESSION['start_date'];
  $enddate = $_SESSION['end_date'];


  $sql1 = "select bid from booking where reg_no in (select reg_no from vehicle_list where location ='$location');";
  $list = $con->query($sql1);
  if(mysqli_num_rows($list) == 0)
  {
        $sql = "select vl.Reg_no,vl.year,vl.price,vd.vname,vd.vrange,vd.class,vd.charge_time,vd.fast_charge,vd.acceleration,vd.dimension,vd.brakes,vd.capacity,vd.image from vehicle_list vl,vehicle_details vd WHERE vd.vname=vl.name and vl.location='$location' and vd.class='$type';";
  }
  else 
  {
	 $sql = "select vl.Reg_no,vl.year,vl.price,vd.vname,vd.vrange,vd.class,vd.charge_time,vd.fast_charge,vd.acceleration,vd.dimension,vd.brakes,vd.capacity,vd.image from vehicle_list vl,vehicle_details vd,booking b WHERE vd.vname=vl.name and vl.location='$location' and vd.class='$type' and vl.reg_no not in (select reg_no from booking) union (select vl.Reg_no,vl.year,vl.price,vd.vname,vd.vrange,vd.class,vd.charge_time,vd.fast_charge,vd.acceleration,vd.dimension,vd.brakes,vd.capacity,vd.image from vehicle_list vl,vehicle_details vd,booking b WHERE vd.vname=vl.name and vl.location='$location' and vd.class='$type' and vl.reg_no = b.reg_no and b.start_date > '$enddate' )union (select vl.Reg_no,vl.year,vl.price,vd.vname,vd.vrange,vd.class,vd.charge_time,vd.fast_charge,vd.acceleration,vd.dimension,vd.brakes,vd.capacity,vd.image from vehicle_list vl,vehicle_details vd,booking b WHERE vd.vname=vl.name and vl.location='$location' and vd.class='$type' and vl.reg_no = b.reg_no and b.end_date < '$startdate') ;";
  }

$all_product = $con->query($sql);

if(isset($_POST['car'])){
    $_SESSION['car']=$_POST['car'];

    header("Location: order.php");
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Green-A-Way</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="select.css">

</head>

<body>

<header class="text-gray-200 bg-gray-900 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <nav class="flex lg:w-2/5 font-medium flex-wrap items-center text-base md:ml-auto">
        
          
      </nav>
      <a class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-white lg:items-center lg:justify-center mb-4 md:mb-0">
        <img src="images/logo1.png" alt="logo"> 
          <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        <span class="ml-3 text-xl xl:block lg:hidden">GREEN-A-WAY</span>
      </a>
      <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
       <a href="profile.php"><button class="mr-5  hover:text-black-900 hover:bg-gray-700 rounded text-base mt-4 md:mt-0 ml-3 text-xl xl:block lg:hidden"><?php Echo  $_SESSION['username'] ?></button></a>
        <a href="logout.php"><button class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">LOG OUT</a>
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
            <path d="M5 12h14"></path>
            <path d="M12 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
    </div>
</header>

<!-- partial:index.partial.html -->
<form action="#" method="POST">
<main>
    <?php
        while($row = mysqli_fetch_assoc($all_product)){

    ?>
<div class="wrapper">
  <div class="container">
    <div class="top" style="background-image:url('<?php echo $row["image"]; ?>');"></div>
    <div class="bottom">
      <div class="left">
        <div class="details">
          <p><?php echo $row["Reg_no"];?></p>
          <h3><?php echo $row["vname"]; ?></h3>
          <p>Rs<?php echo $row["price"]; ?>/hr</p>
        </div>
        <label class="buy">
        <input name="car" type="radio" value="<?php echo $row["Reg_no"]; ?>" onclick="this.form.submit()"></input>
        <i class="material-icons">add_shopping_cart</i>
        </label>
      </div>
      <div class="right">
        <div class="done"><i class="material-icons">done</i></div>
        <div class="details">
          <h1><?php echo $row["vname"]; ?></h1>
          <p>Added to your ride of the day </p>
        </div>
        <div class="remove"><i class="material-icons">clear</i></div>
      </div>
    </div>
  </div>
  <div class="inside">
    <div class="icon"><i class="material-icons">info_outline</i></div>
    <div class="contents">
      <table>
        <tr>
          <th>Certified full Charge range</th>
          <th><?php echo $row["vrange"]; ?> km</th>
        </tr>
        <tr>
          <td>Charging time(15A)</td>
          <td><?php echo $row["charge_time"]; ?>hrs</td>
        </tr>
        <tr>
          <th>Fast charging time(80%)</th>
          <th><?php echo $row["fast_charge"]; ?> min</th>
        </tr>
        <tr>
          <th>Acceleration (0-100 kmph in sec)</th>
          <th><?php echo $row["acceleration"]; ?>**</th>
        </tr>
        <tr>
          <td>Length X Width X Height (mm)</td>
          <td><?php echo $row["dimension"]; ?></td>
        </tr>
        <tr>
          <th>Brakes (front,rear)</th>
          <th><?php echo $row["brakes"]; ?></th>
        </tr>
       <!-- <tr>
          <td>Manufacturing year</td>
          <td><?//php echo $row["year"]; ?> </td>
        </tr>!-->
        <tr>
          <th>Seating capacity</th>
          <th><?php echo $row["capacity"]; ?></th>
        </tr>
      </table>
    </div>
  </div>  
</div>
<?php
    }
?>
</main> 
</form>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  <script  src="selec.js"></script>

</body>

<footer class="text-gray-600 body-font">
    <div class="container px-0 py-0 mx-auto flex items-center sm:flex-row flex-col">
      <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
          <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
        <span class="ml-3 text-xl">Green-A-Way</span>
      </a>
      <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2023 Green-A-Way —
        <a href="https://twitter.com/knyttneve" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@Apsit</a>
      </p>
      <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
        <a class="text-gray-500">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
            <circle cx="4" cy="4" r="2" stroke="none"></circle>
          </svg>
        </a>
      </span>
    </div>
</footer>
</html>