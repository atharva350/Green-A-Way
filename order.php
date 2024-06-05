<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");


require_once 'db.php';

$username = $_SESSION['username'];
$today=date("y-m-d");
$sql100 = "select * from cust_details where cid=(select id from users where username = '$username');";
$details = $con->query($sql100);
if (mysqli_num_rows($details) == 0){
    header("Location: update.php");
}

$car=$_SESSION['car'];
$duration=$_SESSION['duration'];
$location=$_SESSION['locationpass'];
$username = $_SESSION['username'];
$startdate = $_SESSION['start_date'];
$enddate = $_SESSION['end_date'];
$starttime = $_SESSION['start_time'];
$endtime = $_SESSION['end_time'];
$temp="active";



 $sql1 = "select * from vehicle_list where Reg_no='$car';";
 $sql2 = "select * from states where city ='$location';";
 $car_details = $con->query($sql1);
 $car_details2 = $con->query($sql1);
 $dropdown = $con->query($sql2);
 while($xyz = mysqli_fetch_assoc($car_details2)){
  $subtotal=$duration * $xyz["price"];
}

 if(isset($_POST['submit'])){
    $ship_name=$_POST['ship_name'];
    $ship_add1=$_POST['ship_add1'];
    $ship_add2=$_POST['ship_add2'];
    $ship_city=$_POST['ship_city'];
    $ship_state=$_POST['ship_state'];
    $ship_province=$_POST['ship_province'];
    $ship_pincode=$_POST['ship_pincode'];
    
    $status2=$_POST['billing-same'];
    if($status2==1)
    {
        $bill_name=$_POST['ship_name'];
        $bill_add1=$_POST['ship_add1'];
        $bill_add2=$_POST['ship_add2'];
        $bill_city=$_POST['ship_city'];
        $bill_state=$_POST['ship_state'];
        $bill_province=$_POST['ship_province'];
        $bill_pincode=$_POST['ship_pincode'];
    }
    else {
	    $bill_name=$_POST['bill_name'];
        $bill_add1=$_POST['bill_add1'];
        $bill_add2=$_POST['bill_add2'];
        $bill_city=$_POST['bill_city'];
        $bill_state=$_POST['stt'];
        $bill_province=$_POST['bill_province'];
        $bill_pincode=$_POST['bill_pincode']; 
    }
    $damage=$_POST['damage'];
    if($damage == 249)
    {
        $package='Basic';
    }
    else if($damage == 749)
    {
        $package='Peace Of Mind';
    }
    else 
    {
        $package='Standard';
    }
    
    $status=$_POST['temp'];
    if($status == 1)
    {
        $discount=$subtotal * 0.1;
    }
    else {
	      $discount = 0;
    }
    $tax=($subtotal+$damage-$discount)*0.18;
    $total=$subtotal+$damage-$discount+$tax;

    $sql3= "SELECT id FROM users WHERE username = '$username';";
    $result = $con->query($sql3);
       
    while($row1 = mysqli_fetch_assoc($result)){
     while($row2 = mysqli_fetch_assoc($car_details)){
 
        $sql4 = "INSERT INTO booking(cid,reg_no,start_date,end_date,start_time,end_time,package,status,booking_date,duration)values('$row1[id]','$row2[Reg_no]','$startdate','$enddate','$starttime','$endtime','$package','$temp','$today','$duration');";
        mysqli_query($con,$sql4);
     
    $sql5="select bid from booking where cid ='$row1[id]'and reg_no ='$row2[Reg_no]' and start_date='$startdate' and end_date='$enddate' and start_time='$starttime'and end_time='$endtime'and package='$package';";
    $result10 = $con->query($sql5);
     }}
    while($row3 = mysqli_fetch_assoc($result10)){
      $_SESSION['bid']=$row3['bid'];
      $sql6="insert into price values('$row3[bid]','$duration','$subtotal','$damage','$tax','$discount','$total');";
      mysqli_query($con,$sql6);
      $sql7="insert into shipping values('$ship_name','$ship_add1','$ship_add2','$ship_city','$ship_state','$ship_province','$ship_pincode','$row3[bid]');";
      mysqli_query($con,$sql7);
      $sql8="insert into billing values('$bill_name','$bill_add1','$bill_add2','$bill_city','$bill_state','$bill_province','$bill_pincode','$row3[bid]');";
      mysqli_query($con,$sql8);
    }
    header("Location: receipt.php");
 }

?>


<!DOCTYPE html>
<html lang="en" >
<head> 
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://fonts.googleapis.com/css?family=Muli:400,700,800,900" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="order.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
   <script src="cities.js"></script>

</head>

<body>
<form action="#" method="POST">
<div class="checkout">
 
  <div class="checkout__form">
   
        <div class="pages">
            <?php
                while($row = mysqli_fetch_assoc($dropdown)){
            ?>
            <div class="page page--1  is-active"> 
                <p class="paths">
                    <span class="primary">Customer information</span> > Damage protection package > Payment method > Confirm Order
                </p>
                <header class="header">
                    <h2>Customer information</h2>
                </header>
          
                <header class="header">
                    <h2>Shipping address</h2>
                </header>
                <p class="microcopy">Please tell us where to deliver your car.</p>

                <div class="f">
                    <div class="input">
                        <label for="name" class="input__label">Reciever's name <span class="required">(required)</span></label>
                          <input id="name" type="text" class="input__input" required name="ship_name" />
                    </div>
                    <div class="f40">
                        <div class="input">
                            <label for="appartment" class="input__label">Apt. No, House No, etc. <span class="required">(required)</span></label>
                            <input id="appartment" type="text" class="input__input" required name="ship_add1" />
                      </div>
                    </div>
                    <div class="f60">
                        <div class="input">
                            <label for="address" class="input__label">Address <span class="required">(required)</span></label>
                            <input id="address" type="text" class="input__input" required name="ship_add2" />
                        </div>
                    </div>
                    <!--<div class="collapser">
                      <div class="collapser__label"><a href="#">Add another address line</a></div>
                      <div class="collapser__content">
                        <div class="input">
                          <label for="address2" class="input__label">Address <span class="optional">(optional)</span></label>
                          <input id="address2" type="text" class="input__input" />
                        </div>
                      </div>
                    </div>-->
                    <!--<div class="f40"> -->
                    <div class="input">
                       <label for="city" class="input__label">City <span class="required">(required)</span></label>
                       <input id="city" type="text" class="input__input" required name="ship_city" />
                    </div>
                    <!--</div> -->
                    <div class="f35">
                       <div class="input input--select">
                         <label for="country" class="input__label">State <span class="required">(required)</span></label>
                         <select name="ship_state" id="country" class="input__input">
                            <option disabled>State</option>
                            <option value="<?php echo  $row["state"];?>" checked><?php echo  $row["state"];?> </option>       
                         </select>
                       </div>
                    </div>
                    <div class="f35">
                       <div class="input input--select">
                         <label for="province" class="input__label">Province <span class="required">(required)</span></label>
                         <select name="ship_province" id="province" class="input__input">
                           <option disabled>Province</option>
                           <option value="<?php echo  $row["city"];?>" checked><?php echo  $row["city"];?> </option>
                         </select>
                       </div>
                    </div>
                    <div class="f30">
                       <div class="input">
                         <label for="postalcode" class="input__label">PIN CODE <span class="required">(required)</span></label>
                         <input id="postalcode" name="ship_pincode" type="text" class="input__input" required maxlength="6" minlength="6" data-mask="^\d{3}[\-\s]?\d{3}$" />
                         <div class="input__error">Please enter a valid PINCODE.</div>
                       </div>
                    </div>
                </div>

                <div class="f">
                    <label for="billing-same" class="control">
                      <input type="checkbox" value="1" name="billing-same" id="billing-same" class="control__input" checked />
                      <div class="control__label">My <b>billing information</b> is the same as my <b>shipping information</b>.</div>
                    </label>
                </div>
          
                <div id="billing">
          
                <header class="header">
                  <h2>Billing address</h2>
                </header>
                <p class="microcopy">The person that will be billed for this order, if different from the shipping receiver.</p>
          
                <div class="f">
                  <div class="input">
                    <label for="name" class="input__label">Full name <span class="required"></span></label>
                    <input id="name" type="text" class="input__input" name="bill_name" />
                  </div>
                  <div class="f40">
                    <div class="input">
                      <label for="appartment" class="input__label">Apt. No, House No, etc. <span class="required"></span></label>
                      <input id="appartment" type="text" class="input__input" name="bill_add1" />
                    </div>
                  </div>
                  <div class="f60">
                    <div class="input">
                      <label for="address" class="input__label">Address <span class="required"></span></label>
                      <input id="address" type="text" class="input__input" name="bill_add2" />
                    </div>
                  </div>
                  <!--<div class="collapser">
                    <div class="collapser__label"><a href="#">Add another address line</a></div>
                    <div class="collapser__content">
                      <div class="input">
                        <label for="address2" class="input__label">Address <span class="optional">(optional)</span></label>
                        <input id="address2" type="text" class="input__input" />
                      </div>
                    </div>
                  </div>-->
                  <!--<div class="f40"> -->
                  <div class="input">
                    <label for="city" class="input__label">City <span class="required"></span></label>
                    <input id="city" type="text" class="input__input" name="bill_city" />
                  </div>
                  <!--</div> -->
                  <div class="f35">
                    <div class="input input--select">
                      <label for="stt" class="input__label">State  <span class="required"></span></label>
                      <select onchange="print_city('state', this.selectedIndex);" id="sts" name ="stt" class="input__input"  ></select>
                    </div>
                  </div>
                  <div class="f35">
                    <div class="input input--select">
                      <label for="state" class="input__label">Province <span class="required"></span></label>
                      <select id ="state" class="input__input" name="bill_province"></select>
                    </div>
                  </div>
                  <div class="f30">
                    <div class="input">
                      <label for="postalcode" class="input__label">PIN CODE <span class="required"></span></label>
                      <input id="postalcode" name="bill_pincode" type="text" class="input__input" data-mask="^\w{1}\d{1}\w{1}\s*\d{1}\w{1}\d{1}$" />
                      <div class="input__error">Please enter a valid PINCODE.</div>
                    </div>
                  </div>
                </div>
                </div>

                <div class="form__footer">
                    <button type="button" class="btn btn--primary js-goto" id="next" data-page="2" >
                      <span class="btn__label">Continue to Damage protection package</span>
                      <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                    </button>
                    <button class="btn btn--transparent secondary">
                      <svg class="btn__icon"><a:href="select.php"></a></svg>
                      <span class="btn__label"><a href="select.php">Return Car Selection</a></span>
                      <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                    </button>
                </div>
                <?php } ?>  
            </div>
            <div class="page page--2" id="payment_method">
               <p class="paths">
                 Customer information > <span class="primary">Damage protection package</span> > Payment method > Confirm order
               </p>
               <header class="header">
                <h2>Damage protection package</h2>
               </header>
               <p class="microcopy">Select the damage protection package you would like to use.</p>

               <div class="f f--no-margin">
                <label for="shipping-free" class="control block is-selected">
                  <input type="radio" name="damage" id="shipping-free" class="control__input" value="249" />
                  <div class="control__label">
                    Basic
                    <div class="microcopy">You pay up to INR 5499 in case of any damage.</span>.</div>
                  </div>
                  <span class="control__extra">&#8377 249</span>
                </label>

                <label for="shipping-standard" class="control block">
                  <input type="radio" name="damage" id="shipping-standard" class="control__input" value="499" checked />
                  <div class="control__label">
                    Standard
                    <div class="microcopy">You pay up to INR 3499 in case of any damage.</div>
                  </div>
                  <span class="control__extra">&#8377 499</span>
                </label>

                <label for="shipping-rush" class="control block">
                  <input type="radio" name="damage" id="shipping-rush" class="control__input" value="749" />
                  <div class="control__label">
                    Peace of mind
                    <div class="microcopy">You pay up to INR 1499 in case of any damage.</div>
                  </div>
                  <span class="control__extra">&#8377 749</span>
                </label>
               </div>
          
               <div class="form__footer">
                <button class="btn btn--primary js-goto" data-page="3">
                  <span class="btn__label">Continue to Payment Details</span>
                  <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                </button>
                <button class="btn btn--transparent secondary js-goto" data-page="1">
                  <svg class="btn__icon"><use xlink:href="#icon-navigate_before"></use></svg>
                  <span class="btn__label">Return to Customer information</span>
                  <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                </button>
               </div>
            </div>
       
            <div class="page page--3">
              <p class="paths">
                  Customer information > Damage protection package ><span class="primary"> Payment method</span> > Confirm order
              </p>
              <header class="header">
                <h2>Payment</h2>
              </header>
              <p class="microcopy">Enter your payment details</p>

              <div class="f f--no-margin">
                <label for="payment-cc" class="control block is-selected">
                  <input type="radio" name="payment" id="payment-cc" class="control__input" checked />
                  <div class="control__label">
                    Credit/Debit card
                    <div class="microcopy">Pay safely and securely with your credit card.</div>
                  </div>
                  <span class="control__extra">
                    <svg class="control__icon"><use xlink:href="#icon-credit-card"></use></svg>
                    <svg class="control__icon"><use xlink:href="#icon-credit-card"></use></svg>
                    <svg class="control__icon"><use xlink:href="#icon-credit-card"></use></svg>
                  </span>
                </label>

                <div class="block block--collapse">
                  <div class="f">
                    <div class="input is-selected">
                      <svg class="input__icon"><use xlink:href="#icon-lock"></use></svg>
                      <label for="ccnumber" class="input__label">Credit card number <span class="required">(required)</span></label>
                      <input id="ccnumber" type="text" class="input__input" required data-mask="^\d{4}[\-\s]?\d{4}[\-\s]?\d{4}[\-\s]?\d{4}$" />
                      <div class="input__error">Please enter a valid credit card number.</div>
                    </div>
                    <div class="input is-selected">
                      <div class="input">
                        <label for="name" class="input__label">Your full name <span class="required">(required)</span></label>
                        <input id="name" type="text" class="input__input" required />
                      </div>
                      <div class="input__error">Please enter a valid credit card number.</div>
                    </div>
                    <div class="f30">
                      <div class="input input--select">
                        <label for="ccmonth" class="input__label">Expiry month <span class="required">(required)</span></label>
                        <select name="ccmonth" id="ccmonth" class="input__input" required>
                          <option disabled selected>MM</option>
                          <option value="1">01 - January</option>
                          <option value="2">02 - February</option>
                          <option value="3">03 - March</option>
                          <option value="4">04 - April</option>
                          <option value="5">05 - May</option>
                          <option value="6">06 - June</option>
                          <option value="7">07 - July</option>
                          <option value="8">08 - August</option>
                          <option value="9">09 - September</option>
                          <option value="10">10 - October</option>
                          <option value="11">11 - November</option>
                          <option value="12">12 - December</option>
                        </select>
                      </div>
                    </div>
                    <div class="f30">
                      <div class="input input--select">
                        <label for="ccyear" class="input__label">Expiry year <span class="required">(required)</span></label>
                        <select name="ccyear" id="ccyear" class="input__input" required>
                          <option disabled selected>YY</option>
                          <option value="2024">24</option>
                          <option value="2025">25</option>
                          <option value="2026">26</option>
                          <option value="2027">27</option>
                          <option value="2028">28</option>
                          <option value="2029">29</option>
                          <option value="2030">30</option>
                        </select>
                      </div>
                    </div>
                    <div class="f40">
                      <div class="input">
                        <svg class="input__icon"><use xlink:href="#icon-help"></use></svg>
                        <label for="ccsecurity" class="input__label">CVV <span class="required">(required)</span></label>
                        <input id="ccsecurity" type="password" class="input__input" data-mask="\d{3}$" maxlength="3" minlength="3" />
                        <div class="input__error">Please enter a valid CVV code.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
              <div class="message message--info is-visible">Your <b>credit card</b> will be charged as soon as you confirm order.</div>
              <div class="message message--info is-hidden">You will be redirected to <b>PayPal</b> as soon as you finish the current step.</div>
          
              <div class="form__footer">
                <button class="btn btn--primary js-goto" data-page="4">
                  <span class="btn__label">Confirm order</span>
                  <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                </button>
                <button class="btn btn--transparent secondary js-goto" data-page="2">
                  <svg class="btn__icon"><use xlink:href="#icon-navigate_before"></use></svg>
                  <span class="btn__label">Return to Shipping method</span>
                  <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                </button>
              </div>
            </div>
            <div class="page page--4">
                <p class="paths">
                      Customer information > Damage protection package > Payment method > <span class="primary">Confirm order</span>
                </p>
                <header class="header">
                  <h2>Confirm order</h2>
                </header>
                <p class="microcopy">
                    TERMS & CONDITIONS:<br>
                    1. If the vehicle not returned on time then &#8377 500 per hour will be charged.<br>
                    2. Person only whose documents are submitted can drive the car. In case of change of driver company must be notified prior to the change.<br>
                    3. If the vehicle get any physical damage then the authority has every right to take the entire amount from the customer(amount depends on company's policy and selected damage protection package).<br>
                    4. If the customer doesn't have the required document at the time of vehicle delivery he/she may be charged &#8377 2000 and the customer id will be blacklisted. Legal actions will be taken against fake documents.<br>
                    5. Not following government rules and regulations will lead to fine or even jail.<br>
                    6. Read company's policy for more details
                </p>
                <div class="f">
                    <label for="confirmation" class="control">
                      <input type="checkbox" id="confirmation" class="control__input" required />
                      <div class="control__label">I, hereby confirm that all information enterd by me is correct. I have read the company's policy and agree to its terms and conditions.</div>
                    </label>
                </div>
          
          
                <div class="form__footer">
                    <!--<button type="submit" class="btn btn--primary js-goto" data-page="4">
                      <span class="btn__label">Confirm order </span>
                      <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                    </button>-->
                    <button type="submit" name="submit" value="confirm order" id="submit"  class="btn btn--primary">Confirm Order </button>
                    <button class="btn btn--transparent secondary js-goto" data-page="3">
                      <svg class="btn__icon"><use xlink:href="#icon-navigate_before"></use></svg>
                      <span class="btn__label">Return to Payment method</span>
                      <svg class="btn__loader" viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle></svg>
                    </button>
                </div>
            </div>
        </div>
  
  </div>

  <?php
     while($row = mysqli_fetch_assoc($car_details)){
     $subtotal=$duration * $row["price"];
  ?>
  <div class="checkout__summary">
    
    <!--<div class="logo"></div> -->
    
    <header class="header">
      <h2>Order summary</h2>
    </header>
    <p class="microcopy">A summary of your total order.</p>
    
    <div class="collapser">
      <a href="#" class="collapser__label">Add a coupon code</a>
      <div class="collapser__content"> 
        <!--<form onsubmit="">-->
        <div class="f">
          <div class="f70">
            <div class="input">
              <label for="in" class="input__label">Coupon code <span class="optional">(optional)</span></label>
              <input type="text" name="coupon" id="in" class="input__input" style='text-transform:uppercase'>
            </div>
              <span id="usernameError"></span>
              </div>
               <div class="f30">
            <input type="button" value="Submit"  class="btn btn--secondary btn--full js-add-gift-card" onClick="validate(coupon)" />
            <input type="checkbox" name="temp" value="1" id="temp" </input>
            <!--</form>-->
          </div>

          <span id="applied"></span>
          <span id="err"></span>
        </div>
      </div>
      <div class="f">

          <table class="pricing">
            <tbody>
              <tr>
                <td class="pricing__label"><?php echo  $row["name"];?> </td>
                <td class="pricing__price">&#8377 <?php echo  $row["price"];?>/Hr</td>
              </tr>
              <tr>
                <td class="pricing__label">DURATION OF RENTING </td>
                <td class="pricing__price"><?php echo $duration;?> hour</td>
              </tr>
              <tr>
                <td class="pricing__label">Subtotal</td>
                <td class="pricing__price">&#8377 <?php echo $subtotal;?> </td>
              </tr>
              <tr>
                <td class="pricing__label">Damage protection</td>
                <td class="pricing__price">&#8377<span id="result">499</span></td>
              </tr>
              <tr class="discount" id="discount">
                <td class="pricing__label">Discount <small>(-10%)</small> on subtotal</td>
                <td class="pricing__price">&#8377<span id="disc"></span></td>
              </tr>
              <tr>
                <td class="pricing__label">Tax <small>(18%)</small></td>
                <td class="pricing__price">&#8377 <span id="taxi"></span></td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="pricing__total">
                <td class="pricing__label">Total</td>
                <td class="pricing__price">&#8377 <b><span id="total_amount"></span></b></td>
              </tr>
            </tfoot>
          </table>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
  <!-- partial -->
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
   <script>
   var discount_amount=0;

   var subtotal = '<?php echo $subtotal;?>';
   var taxamount=(subtotal-discount_amount+499)*0.18;
   var total = parseInt(subtotal)+499+taxamount;
   var totalnotax = parseInt(subtotal) + 499;

   setInterval(set(),10000);
   function set(){
   //var taxamount = 0;
   document.getElementById('taxi').innerHTML= taxamount.toFixed(2);
   document.getElementById('total_amount').innerHTML= total.toFixed(2);
   }
  
   </script>
   <script language="javascript">print_state("sts");</script>
  <script  src="order.js"></script>
  </form>
</body>

</html>
