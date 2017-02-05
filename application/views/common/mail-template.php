<?php
if($tour != ''){
	$txt1 = "Your booking for the tour, ".$tour_name." has been initiated successfully";
}
else{
	$txt1 = "Your booking for ttransfer service has been initiated successfully";
}
$booking_mail = '<!DOCTYPE html>
<html>
<head>
<title>Booking</title>
</head>
<body>
Hi, '.$user_name.'
<br><br>
'.$txt1.'. We will review youe booking and will contact you by email.
<br><br><br>
Thanks
<br>
Dubai Private Tours<br>
<a href="http://dubaiprivatetours.com">http://dubaiprivatetours.com</a>
</body>
</html>';
?>