<?php
include("auth_session.php");

require_once 'db.php';

date_default_timezone_set('Asia/Calcutta');
$username = $_SESSION['username'];
$today=date("y-m-d");
$text="cancelled";


   $sql1= "SELECT id FROM users WHERE username = '$username';";
   $id = $con->query($sql1);
   while($row1 = mysqli_fetch_assoc($id)){
       $sql2= "SELECT * from booking where cid ='$row1[id]';";
       $result = $con->query($sql2);
    }

    if(isset($_POST['submit'])){
    $bid=$_POST['submit'];
    $sql4="update booking set status='$text' where bid='$bid';";
    mysqli_query($con,$sql4);
    header("Location: booking.php");
    }
     if(isset($_POST['print'])){
    $bid=$_POST['print'];
    $_SESSION['invoiceno']=$bid;
    header("Location: bill.php");
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
    <link rel="stylesheet" href="booking.css">
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
        <main class="main-container">
        <?php
            if (mysqli_num_rows($result) > 0) {
        ?>
        <form action="#" method="POST">
        <table>
	        <tr>
                <th>bid No</th>
                <th>Vehicle Name</th>
                <th>Vehicle Reg No.</th>
                <th>Start date</th>
                <th>End date</th>
                <th>City</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
			<?php
			    $i=0;
			    while($row2 = mysqli_fetch_array($result)) {
                $sql3="SELECT * from vehicle_list where Reg_no='$row2[reg_no]';";
                $result2 = $con->query($sql3);
                while($row3 = mysqli_fetch_array($result2)) {
			?>
	        <tr>
                <td><?php echo $row2["bid"]; ?></td>
                <td><?php echo $row3["name"]; ?></td>
                <td><?php echo $row2["reg_no"]; ?></td>
                <td><?php echo $row2["start_date"]; ?></td>
                <td><?php echo $row2["end_date"]; ?></td>
                <?php
                    if($row2["status"]=="active")
                    {
                    if(date("y-m-d",strtotime($row2["start_date"]))>$today){
                        $status="Pending";
                    }
                    elseif(date("y-m-d",strtotime($row2["start_date"]))<=$today && date("y-m-d",strtotime($row2["end_date"]))>$today){
                        $status="Ongoing";
                    }
                    else{
                        $status="Completed";
                    }
                    }
                    else{
                        $status="Cancelled";
                    }
                ?>
                <td><?php echo $row3["location"]; ?></td>
                <td><?php if($status=="Ongoing") { ?>
                <span class="text-orange"><?php echo $status; ?></span>
                <?php } elseif($status=="Completed") { ?>
                <span class="text-green"><?php echo $status; ?></span>
                <?php } elseif($status=="Pending") { ?>
                <span class="text-blue"><?php echo $status; ?></span>
                <?php } else { ?>
                <span class="text-red"><?php echo $status; ?></span> <?php } ?></td>
                <?php
                    if(date("y-m-d",strtotime($row2["start_date"]))>$today && $row2["status"]=="active"){
                ?>
                <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <p>Are you sure you want to cancel this booking ?</p>
            <button type="button" id="back">NO, Take me back</button>
            <button type="submit" name="submit" id="yes" value="<?php echo $row2["bid"] ?>">Yes, Cancel the booking</button>

        </div>

        </div>
                <td><span class="material-icons-outlined">print</span><button type="submit" id="myBtn2" name="print"  value="<?php echo $row2["bid"] ?>">Invoice</button><br><br><span class="material-icons-outlined"> cancel</span><button type="button" id="myBtn">Cancel</button></td>
                <?php }
                else { ?>
                <td><span class="material-icons-outlined">print</span><button type="submit" id="myBtn2" name="print"  value="<?php echo $row2["bid"] ?>">Invoice</button></td>
                <?php } ?>
            </tr>
			<?php
                }
			?>
    <?php  $i++;
	}?>
    </table>
    </form>
        <?php
        }
        else
        { ?>
            <div class="notfound">
            <h1> NO Results Found </h1>
            <img src="images/notfound.png"> </img>
            <a href="main.php"><h1> Click here to book your first vehicle</h1></a>
            </div>
        <?php } ?>
        </main>
        <!--end main-->

    </div>


    <script src="profile.js"></script>
    <script src="booking.js"></script>
</body>
</html>