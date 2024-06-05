<?php
include("auth_session.php");

require_once 'db.php';

$today=date("d-m-y");
$bid =  $_SESSION['invoiceno'];
$username = $_SESSION['username'];

$sql1="Select * from booking where bid = '$bid'";
$sql2="Select * from billing where bid = '$bid'";
$sql3="Select * from shipping where bid = '$bid'";
$sql4="Select * from price where bid = '$bid'";
$sql5="select name,price from vehicle_list where Reg_no = (select reg_no from booking where bid = '$bid'); ";
$sql6="select * from cust_details where cid = (select id from users where username = '$username');";
$sql7="select * from users where username = '$username';";

$result1 = $con->query($sql1);
$result2 = $con->query($sql2);
$result3 = $con->query($sql3);
$result4 = $con->query($sql4);
$result5 = $con->query($sql5);
$result6 = $con->query($sql6);
$result7 = $con->query($sql7);
?>





<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Green-A-Way</title>
  <link rel="stylesheet" href="bill.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
		<tr class="top_rw">
		   <td colspan="2">
           <?php while($row1 = mysqli_fetch_assoc($result1)){ ?>
		      <h2 style="margin-bottom: 0px;"> Tax invoice/Bill of Supply/Cash memo </h2>

			  <span style=""> Booking ID: #<?php echo $bid ?> Booking Date: <?php echo $row1["booking_date"]; ?> </span>
		   <?php } ?></td>
		    <td  style="width:30%; margin-right: 10px;">
		        Invoice Date: <?php echo $today ?>
		   </td>
		</tr>
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
							<b> Green-A-Way </b> <br>
                                Survey No 12, Ghodbunder Road <br>
opp. Hypercity mall <br>
Kasarvadavali, Thane west <br>
Maharashtra, Pin Code :400615 <br>
PAN: AALFN0535C <br>
GSTIN: 27AALFN0535C1ZK <br><br>
<?php while($row6 = mysqli_fetch_assoc($result6)){ ?>
<b>Billed To : <?php echo $row6["fname"];?> <?php echo $row6["lname"]; ?></b><?php }?>
<?php while($row7 = mysqli_fetch_assoc($result7)){ ?>
<br>Contact Number: <?php echo $row7["mob"]; ?>
<br>email: <?php echo $row7["email"]; ?><br>
<?php } ?>
                            </td>
                            <td>
                            <img src ="images/logo.png" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                  <td colspan="3">
                    <table>
                        <tr>
                            <td colspan="2">
                            <?php while($row3 = mysqli_fetch_assoc($result3)){ ?>
							<b> Shipping Address: <?php echo $row3["name"]; ?> </b> <br>
                               <?php echo $row3["add1"]; ?> <?php echo $row3["add2"]; ?><br>
                               <?php echo $row3["city"]; ?> , <?php echo $row3["province"]; ?><br>
                               <?php echo $row3["state"]; ?> - <?php echo $row3["pincode"]; } ?>
                            </td>
                            <td> 
                            <?php while($row2 = mysqli_fetch_assoc($result2)){ ?>
							<b>Billing Address: <?php echo $row2["name"]; ?> </b> <br>
                               <?php echo $row2["add1"]; ?> <?php echo $row2["add2"]; ?><br>
                               <?php echo $row2["city"]; ?> , <?php echo $row2["province"]; ?><br>
                               <?php echo $row2["state"]; ?> - <?php echo $row2["pincode"]; } ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
                            <td colspan="3">
            <table cellspacing="0px" cellpadding="2px">
            <tr class="heading">
                <td style="width:25%;">
                    ITEM
                </td>
				<td style="width:10%; text-align:center;">
                    Price (INR)
                </td>
                <td style="width:10%; text-align:right;">
                    Duration
                </td>
				 <td style="width:12%; text-align:right;">
                    Subtotal (INR)
                </td>
				 <td style="width:12%; text-align:right;">
                    Discount (INR)
                </td>
				 <td style="width:12%; text-align:right;">
                   Damage Protection package (INR)
                </td>
                <td style="width:9%; text-align:right;">
                   Tax(18%) (INR)
                </td>
            </tr>
			<tr class="item">
               <?php while($row5 = mysqli_fetch_assoc($result5)){ ?>
               <td style="width:25%;">
                    <?php echo $row5["name"]; ?>
                </td>
                <td style="width:10%; text-align:center;">
                    <?php echo $row5["price"]; ?> /hr
                </td>
                <?php } ?>
                 <?php while($row4 = mysqli_fetch_assoc($result4)){ ?>
                <td style="width:10%; text-align:right;">
                   <?php echo $row4["duration"]; ?> hrs
                </td>
				 <td style="width:12%; text-align:right;">
                   <?php echo $row4["subtotal"]; ?>
                </td>
				 <td style="width:12%; text-align:right;">
                    <?php echo $row4["discount"]; ?>
                </td>
				 <td style="width:12%; text-align:right;">
                     <?php echo $row4["damage"]; ?>
                </td>
                <td style="width:9%; text-align:right;">
                     <?php echo $row4["tax"]; ?>
                </td>
            </tr>
			<tr class="item">
               <td style="width:25%;"></td>
				<td style="width:10%; text-align:center;">
                    
                </td>
                <td style="width:10%; text-align:right;">
                    
                </td>
				 <td style="width:12%; text-align:right;">
                    
                </td>
				 <td style="width:12%; text-align:right;">
                </td>
				 <td style="width:12%; text-align:right;">
                     <b>Grand Total</b>
                </td>
                 <td style="width:9%; text-align:right;">
                     <b><?php echo $row4["total"]; ?></b>
                </td>
            </tr>
            
            
            <?php
            $number =  $row4["total"];
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';} ?>
           
          
          </td>
			</table>
            <tr class="total">
                  <td colspan="3" align="right">  Total Amount in Words :  <b><?php echo $result . "Rupees  " . $points . " Paise"; ?></b> </td>
            </tr>
			<tr>
			   <td colspan="3">
			     <table cellspacing="0px" cellpadding="2px">
				    <tr>
			            <td width="100%">
						<b> Declaration: </b> <br>
We declare that this invoice is just for renting vehicle and it does not say 
that the vehilce belongs to Customer.All the vehicles belong to their respective owners 
and Green-A-Way is just a medium providing vehicles from the company for rental.

                        <br>
                        <br>
                        <br>

                        <b> TERMS & CONDITIONS: </b> <br>
1. If the vehicle not returned on time then &#8377 500 per hour will be charged.<br>
                    2. Person only whose documents are submitted can drive the car. In case of change of driver company must be notified prior to the change.<br>
                    3. If the vehicle get any physical damage then the authority has every right to take the entire amount from the customer(amount depends on company's policy and selected damage protection package).<br>
                    4. If the customer doesn't have the required document at the time of vehicle delivery he/she may be charged &#8377 2000 and the customer id will be blacklisted. Legal actions will be taken against fake documents.<br>
                    5. Not following government rules and regulations will lead to fine or even jail.<br>
                    6. Booking can be cancelled upto one day prior to start date.<br>
                    7. Read company's policy for more details
 


						</td>
                        </tr>
                        <tr>
						<td width="100%">
						 * This is a computer generated invoice and does not
						  require a physical signature
						</td>
			        </tr>
					 <tr>
			            <td width="50%">
						</td>
						<td>
						 	<b></b>
							<br>
							<br>
							<br>
							<br>
						</td>
			        </tr>
			     </table>
			   </td>
			</tr>
        </table>
        <td> <center> Have a happy and safe journey !! </td>
    </div>
<!-- partial -->
  
</body>
</html>
