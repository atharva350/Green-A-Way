<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

require_once 'db.php';

    $username = $_SESSION['username'];
    $sql1= "SELECT id,email,mob FROM users WHERE username = '$username';";
    $id = $con->query($sql1);
       
    while($row1 = mysqli_fetch_assoc($id)){
        $email=$row1["email"];
        $mob=$row1["mob"];
        $sql2= "SELECT * from cust_details where cid ='$row1[id]';";
        $result = $con->query($sql2);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green-A-Way</title>
    <!--Montserrat Font-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="grid-container">


        <!--siderbar-->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">inventory</span> User's Dashboard
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="profile.php">
                    <span class="material-icons-outlined">person</span> Profile
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="update.php">
                    <span class="material-icons-outlined">manage_accounts</span> Update Profile
                    </a>
                </li>
            <!---   <li class="sidebar-list-item">
                    <a href="#">
                    <span class="material-icons-outlined">history</span> History
                    </a>
                </li>  -->
                <li class="sidebar-list-item">
                    <a href="booking.php">
                    <span class="material-icons-outlined">history</span> Your Bookings
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="main.php">
                    <span class="material-icons-outlined">directions_car</span> Create new Booking
                    </a>
                </li>
                <li class="log_out">
                    <a href="logout.php">
                        <span class="material-icons-outlined">logout</span> Log-Out
                    </a>
                  </li>
            </ul>
        </aside>
        <!--end sidebar--> 

        <!--Main-->
        <?php
            if (mysqli_num_rows($result) == 0) {
            header("Location: update.php");
            }
         else{
         while($row2 = mysqli_fetch_assoc($result)){ ?>
        <main class="main-container">
            <div class="top">
				<div class="avtar">
					<img src="images/ANUJ.png" alt="profile pic">
				</div>
				<div class="details">
					<h1>Name :<?php echo  $row2["fname"];?> <?php echo  $row2["lname"];?></h1>
                    <h3>Username :<?php echo  $username;?><h3>
					<h3>Mob :<?php echo  $mob;?><h3>
					<h3>Email : <?php echo  $email ;?></h3>				
				</div>
			</div>
			<br>
			<div class="bottom">
				<div class="moredetails">
					<p>
						Role : User<br><br>
                        Address : <?php echo  $row2["address"];?>
					</p>
				</div>
				<div class="identity">
						<h2>Identity</h2>
						<p>
							Pan Number :  <?php echo  $row2["pan_no"];?><br><br>
							Adhaar Number :<?php echo  $row2["ad_no"];?><br><br>
                            Driving license : <?php echo  $row2["dl_no"];?>
						<p>
				</div>
			</div>
        </main>
        <!--end main-->
        <?php } } ?>

    </div>

    <script src="profile.js"></script>
</body>
</html>