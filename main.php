<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>

<?php

if(isset($_POST['submit'])){
    $location = $_POST['radio'];
    $type = $_POST['radio2'];
    $startdate = $_POST['start_date'];
    $enddate = $_POST['end_date'];
    $starttime = $_POST['start_time'];
    $endtime = $_POST['end_time'];
    $_SESSION['locationpass'] = $location;
    $_SESSION['typepass'] = $type;
    $_SESSION['start_date'] = $startdate;
    $_SESSION['end_date'] = $enddate;
    $_SESSION['start_time'] = $starttime;
    $_SESSION['end_time'] = $endtime;


    $date1 = strtotime($startdate." ".$starttime);
    $date2 = strtotime($enddate." ".$endtime);

    $diff = abs($date2 - $date1);
    $years = floor($diff/(365*60*60*24));
    $months = floor(($diff-$years*365*60*60*24)/(30*60*60*24));
    $days = floor(($diff-$years*365*60*60*24 - $months*30*60*60*24)/(60*60*24));
    $hours = floor(($diff-$years*365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/(60*60));
    $minutes = floor(($diff-$years*365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/60);
    $seconds = floor(($diff-$years*365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

    echo $years." ".$months." ".$days." ".$hours." ".$minutes." ".$seconds;

    

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'project';

    $conn = mysqli_connect($host,$user,$pass,$db);

    
    $sql = "INSERT INTO more values ('$location','$type','$startdate','$enddate','$starttime','$endtime',0)";
    mysqli_query($conn,$sql);

    $_SESSION['duration']=($days * 24)+$hours;

    header("Location: select.php");
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Green-A-Way</title>
    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;800&display=swap" rel="stylesheet" />
    <!-- Line Awesome CDN Link -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="main.js"></script>
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
  

  <div class ="content" id="content">
    <form action="#" method="POST">
    <div class="main-container" id="location">
 
      <h2>What's your City ? </h2>
      <div class="radio-buttons">
        <label class="custom-radio">
          <input type="radio" name="radio" value="bengluru" checked onClick="document.getElementById('content').style.backgroundImage='url(images/banglore-bk.png)';"/>
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Bengaluru" src="images/bangalore.jpeg">
              <h3>Bengaluru</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="mumbai" onClick="document.getElementById('content').style.backgroundImage='url(images/mumbai-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Mumbai" src="images/mum.jpeg">
              <h3>Mumbai</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="delhi-ncr" onClick="document.getElementById('content').style.backgroundImage='url(images/delhi-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Delhi-NCR" src="images/delhi.jpeg">
              <h3>Delhi-NCR</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="jaipur" onClick="document.getElementById('content').style.backgroundImage='url(images/jaipur-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="team" src="images/jaipur.jpeg">
              <h3>Jaipur</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="hyderabad" onClick="document.getElementById('content').style.backgroundImage='url(images/hyderabad-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Hyderabad" src="images/Hyderabad.jpeg">
              <h3>Hyderabad</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="chennai" onClick="document.getElementById('content').style.backgroundImage='url(images/chennai-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Chennai" src="https://th.bing.com/th/id/OIP.mj2LsxM4_BcSIZG-rMiscgHaE3?w=246&h=180&c=7&r=0&o=5&pid=1.7">
              <h3>Chennai</h3>
            </div>
          </span>
        <label class="custom-radio">
          <input type="radio" name="radio" value="amritsar" onClick="document.getElementById('content').style.backgroundImage='url(images/amritsar-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="team" src="images/Amritsar.jpeg">
              <h3>Amritsar</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="ahemedabad" onClick="document.getElementById('content').style.backgroundImage='url(images/ahemedabad-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Ahemedabad" src="https://ngs-space1.sgp1.digitaloceanspaces.com/am/uploads/mediaGallery/image/1658653042367.jpg-org">
              <h3>Ahemedabad</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="udaipur" onClick="document.getElementById('content').style.backgroundImage='url(images/udaipur-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Udaipur" src="https://www.tourmyindia.com/states/rajasthan/image/udaipur-banner.webp">
              <h3>Udaipur</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="Kolkata" onClick="document.getElementById('content').style.backgroundImage='url(images/kolkata-bk.png)';" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
            <img alt="Kolkata" src="https://www.holidify.com/images/bgImages/KOLKATA.jpg">
              <h3>Kolkata</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio" value="pune" onClick="document.getElementById('content').style.backgroundImage='url(images/pune-bk.png)';"/>
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="Pune" src="https://upload.wikimedia.org/wikipedia/commons/1/14/Shaniwaarwada_Pune.jpg">
              <h3>Pune</h3>
            </div>
          </span>
        </label>
        
        <label class="custom-radio">
          <span class="scroller">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <button type="button" onclick="document.getElementById('vehicle').scrollIntoView();">NEXT</button> 
              <h3>Select Vehicle Type</h3>
            </div>
          </span>
        </label>
      </div>
     </div>

    <div class="main-container" id="vehicle">
      <h2>Select Your Ride</h2>
      <div class="radio-buttons">

        <label class="custom-radio">
          <span class="scroller">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
               <button type="button" onclick="document.getElementById('location').scrollIntoView();">BACK</button> 
              <h3>Select Your Location</h3>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <input type="radio" name="radio2" value="mcwg" />
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="scooter" src="images/chetak.png">
              <h3>Scooters</h3>
              <p>Available only for local trips..</p>
            </div>
          </span>
        </label>
        
        <label class="custom-radio">
          <input type="radio" name="radio2" value="lmv" checked/>
          <span class="radio-btn">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
              <img alt="car" src="images/kiaev6.png">
              <h3>Cars</h3>
              <p>Available for both local and intercity trips.</p>
            </div>
          </span>
        </label>
        <label class="custom-radio">
          <span class="scroller"> 
            <i class="las la-check"></i>
            <div class="hobbies-icon">
               <button type="button" onclick="document.getElementById('datetime').scrollIntoView();">NEXT</button>  
              <h3>Select Date And Time</h3>
            </div>
          </span>
        </label>
      </div>
    </div>
    
    <div class="main-container" id="datetime">
      <h2>Select Date And Time</h2>
      <div class="radio-buttons">
        
        <label class="custom-radio">
          <span class="scroller">
            <i class="las la-check"></i>
            <div class="hobbies-icon">
               <button type="button" onclick="document.getElementById('vehicle').scrollIntoView();">BACK</button> 
              <h3>Select Vehicle Type</h3>
            </div>
          </span>
         </label>

         <label class="custom-radio">
           <span class="radio-btn"> 
             <i class="las la-check"></i>
             <div class="hobbies-icon">
               <input type=text id=date_picker1 name="start_date" size=10 placeholder='Start Date' required>
               <h3>Select start date</h3>
             </div>
           </span>
         </label>

         <label class="custom-radio">
           <span class="radio-btn"> 
             <i class="las la-check"></i>
             <div class="hobbies-icon">
               <input type="time" step="3600" id="start_time" name="start_time" min="09:00:00" max="15:00:00" required value="HH%3Amm">
               <h3>Select start Time</h3>
             </div>
           </span>
         </label>

         <label class="custom-radio">
           <span class="radio-btn"> 
             <i class="las la-check"></i>
             <div class="hobbies-icon">
               <input type=text id=date_picker2 size=10 name="end_date" placeholder='End Date' required>
               <h3>Select End date</h3>
             </div>
           </span>
         </label>

         <label class="custom-radio">
           <span class="radio-btn"> 
             <i class="las la-check"></i>
             <div class="hobbies-icon">
               <input type="time" step="3600" id="end_time" name="end_time" min="16:00:00" max="21:00:00" required value="HH%3Amm">
               <h3>Select End Time</h3>
             </div>
           </span>
         </label>

         <label class="custom-radio">
           <span class="scroller">
             <i class="las la-check"></i>
             <div class="hobbies-icon">
               <button type="submit" name="submit">NEXT</button> 
               <h3>Search Available Vehicle</h3>
             </div>
           </span>
         </label>
      </div>
      </form>
    </div>
  </div>

 </body>
 
 <footer class="text-gray-600 body-font">
    <div class="container px-0 py-0 mx-auto flex items-center sm:flex-row flex-col">
      <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
        <span class="ml-3 text-xl">Green-A-Way</span>
      </a>
      <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">  2023 Green-A-Way  
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


