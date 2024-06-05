$(document).ready(function() {
// Jquery code here ///
var startDate;
var endDate;
var period;
var next;
var today = new Date();

var tomorrow = new Date();
tomorrow.setDate = (tomorrow.getDate() + 1);
/*var dd = today.getDate() + 1;
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();*/




var today = new Date();
var dd = today.getDate() + 1;
var mm = today.getMonth() + 2; //January is 0!
var yyyy = today.getFullYear();

next = yyyy + '-' + mm + '-' + dd;

$('#date_picker1').datepicker({
	dateFormat:'yy-mm-dd'
});
$('#date_picker2').datepicker({
	dateFormat:'yy-mm-dd'
});
//////
$('#date_picker1').datepicker('option','minDate',tomorrow);
$('#date_picker1').datepicker('option','maxDate',next);
/////
$('#date_picker1').change(function(){
	startDate=$(this).datepicker('getDate');

	var dd = startDate.getDate();
	var mm = startDate.getMonth() + 2; //January is 0!
	var yyyy = startDate.getFullYear();
	period = yyyy + '-' + mm + '-' + dd; 

	$('#date_picker2').datepicker('option','minDate',startDate);
	$('#date_picker2').datepicker('option','maxDate',period);
});

$('#date_picker2').change(function(){
	endDate=$(this).datepicker('getDate');
	$('#date_picker1').datepicker('option','maxDate',endDate);
});
/////
});
