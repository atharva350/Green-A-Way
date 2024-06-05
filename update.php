<?php
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
    require_once 'db.php';
    $username = $_SESSION['username'];

    $sql1 = "select * from cust_details where cid=(select id from users where username = '$username');";
        $details = $con->query($sql1);
    if(isset($_POST['update'])){

        $fname = $_POST['fname'];
        $lnmae = $_POST['lname'];
        $pan_no = $_POST['panno'];
        $ad_no = $_POST['aadharno'];
        $dl_no = $_POST['license'];
        $address = $_POST['address'];
    
        if(mysqli_num_rows($details) == 0)
        {
            $sql2= "SELECT id FROM users WHERE username = '$username';";
            $result = $con->query($sql2);
       
            while($row = mysqli_fetch_assoc($result)){
                $sql3 = "INSERT INTO cust_details values ('$row[id]','$fname','$lnmae','$pan_no','$ad_no','$dl_no','$address');";
                mysqli_query($con,$sql3);
            }
        }
        else 
        {
            $sql2= "SELECT id FROM users WHERE username = '$username';";
            $result = $con->query($sql2);
       
            while($row = mysqli_fetch_assoc($result)){
                $sql3 = "update cust_details set fname='$fname',lname='$lnmae',pan_no='$pan_no',ad_no='$ad_no',dl_no='$dl_no',address='$address' where cid='$row[id]';";
                mysqli_query($con,$sql3);
            }
        }


        header("Location: profile.php");

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
    <link rel="stylesheet" href="update.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            if (mysqli_num_rows($details) == 0) {
        ?>
        <h2> Your Profile is incomplete. Complete it before making your first booking.</h2>
        <?php } ?>
        <div class="form">
        <?php
            if (mysqli_num_rows($details) == 0) {
        ?>
        <h2>Complete Profile</h2>
        <?php } 
        else {?> 
        <h2>Update Profile</h2>
        <?php } ?>
        <form action="#" method="POST">       
            <div class="input">
                <label>First Name</label>
                <input type="text" name="fname" placeholder="First Name" required pattern="[a-zA-Z'-'\s]*">
            </div>
            <div class="input">
                <label>Last Name</label>
                <input type="text" name="lname" placeholder="Last Name" required pattern="[a-z A-Z '-'\s]*">
            </div>  
            <div class="input">
                <label>Pancard Details</label>
                <input type="text" name="panno" placeholder="Enter Pan-card Details" required pattern="^[A-Za-z]{5}\d{4}[A-Za-z]{1}$">
            </div>
        <!---   <div class="grid-details">  -->
            <div class="input">
                <label>Aadhar Number</label>
                <input type="number" name="aadharno" placeholder="Enter Your Aadhar Number" required pattern="^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$">
            </div>
            <div class="input">
                <label>Driving License</label>
                <input type="text" name="license" placeholder="Enter Driving License Number" required pattern="^[A-Za-z]{2}[0-9]{2}[0-9]{4}[0-9]{7}$">
            </div>
        <!---    </div>    -->
            <div class="profile-img">
                <div class="file-upload">
                    <input type="file" id="image-preview" name="image" class="file-input">
                    <i class="fas fa-user-edit"></i>
                </div>
            </div> 
            <div class="input">
                <label>Address</label>
                <textarea rows="5" name="address" class="input" placeholder="Enter Your Address" required></textarea>
            </div> 
            <div class="submit">
                <input type="submit" name="update" value="Update Now" class="button">
            </div>
        </form>
        </main>
        <!--end main-->

    </div>

    <script src="profile.js"></script>
   
</body>
</html>