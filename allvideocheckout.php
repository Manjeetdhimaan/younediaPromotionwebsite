<?php
	session_start();
	$username=$_SESSION["username"];
	$youtubeURL = $_GET['youtubeURL'];
	$wants = $_GET['wants1'] . "|" . $_GET['wants2'] . "|" . $_GET['wants3'];
	$wants = str_replace('||', '|', $wants);
	if($wants[0]==="|"){
	    $wants=substr($wants, 1);
	}
	if(substr($wants, -1)==="|"){
	    $wants=substr_replace($wants, "", -1);
	}
	$gender = $_GET['gender'];
	$age = $_GET['age'];
	$location = $_GET['location1'] . ": " . $_GET['location2'];
	if(substr($location, -2)===": "){
	    $location=substr_replace($location, "", -2);
	}
	$video_category = $_GET['video_category'];
	$keywords = $_GET['keywords'];
	$budget = $_GET['budget'];
	$views = $budget*50;
	
	$orderDetails = "YouTube URL: " . $youtubeURL . "\nWants: " . $wants . "\nGender: " . $gender . "\nAge: " . $age . "\nLocation: " . $location . "\nVideo Category: " . $video_category . "\nKeywords: " . $keywords . "\nBudget: " . $budget . "\nViews: " . $views;
	
	$conn = new mysqli('localhost', 'webdes57_prom', 'Prom99!!', 'webdes57_prom'); 
	if ($conn->connect_error)
	{
	    die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT order_details FROM users WHERE username = '".$username."'";
	$result = $conn->query($sql);
	$cell=mysqli_fetch_array($result)["order_details"];
	if($cell === NULL || $cell === ""){
	    $sql = "UPDATE users SET order_details='".$orderDetails."' WHERE username = '".$username."'";
	    $result = $conn->query($sql);
	}else{
	    $finalString = $cell . "\n+\n" . $orderDetails;
	    $sql = "UPDATE users SET order_details='".$finalString."' WHERE username = '".$username."'";
	    $result = $conn->query($sql);
	}
	
	$orderStatus="uncomplete";
	$sql = "SELECT order_status FROM users WHERE username = '".$username."'";
	$result = $conn->query($sql);
	$cell=mysqli_fetch_array($result)["order_status"];
	if($cell === NULL || $cell === ""){
	    $sql = "UPDATE users SET order_status='".$orderStatus."' WHERE username = '".$username."'";
	    $result = $conn->query($sql);
	}else{
	    $finalString = $cell . "\n+\n" . $orderStatus;
	    $sql = "UPDATE users SET order_status='".$finalString."' WHERE username = '".$username."'";
	    $result = $conn->query($sql);
	}
	$budget=$budget*75*100;
    
    /* */
    
	$data = array("amount"=>$_GET['budget']*100,"currency"=>"USD", "receipt"=>"receipt#1");
	$postdata = json_encode($data);
	$username="rzp_test_2P0X483ZYFoEah";
	$password="s9GGqAvbpiVgEL6RLQlE6Fjp";
	$URL="https://api.razorpay.com/v1/orders";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
	$result = curl_exec($ch);
	$obj=json_decode($result);
	echo "<p hidden id='hidden'>".$obj->id."</p>";
	echo "<p hidden id='hidden2'>".$username."</p>";
	echo "<p hidden id='hidden3'>".$password."</p>";
	echo "<p hidden id='hidden4'>".$_GET['budget']."</p>";
	curl_close($ch);
?>
<button id="rzp-button1" style="background-color: #FFBA00; color: black; border: none; text-transform: uppercase; padding: 11px; display: none;">Pay With Razorpay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script async defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	var x=document.getElementById("hidden").innerHTML;
	var y=document.getElementById("hidden2").innerHTML;
	var z=document.getElementById("hidden3").innerHTML;
	var budget=document.getElementById("hidden4").innerHTML;
	var options = {
	    "key": "rzp_test_2P0X483ZYFoEah", // Enter the Key ID generated from the Dashboard
	    "amount": budget*100,
	    "currency": "USD",
	    "name": "Acme Corp",
	    "description": "Test Transaction",
	    "image": "https://example.com/your_logo",
	    "order_id": x, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
	    "handler": function (response){
	        var a=response.razorpay_payment_id;
	        var b=response.razorpay_order_id;
	        var c=response.razorpay_signature;
			$.ajax({
				type :'POST',
				data : {razorpay_payment_id: a, razorpay_order_id: b, razorpay_signature: c, key_id: y, key_pw: z, order_id: x},
				url  : 'signature.php',
				success : function(response){
				    window.top.location.href = "user-profile.php";
				},
				error : function(e){
					console.log(e);
				}
			});
	    },
	    "prefill": {
	        "name": "Gaurav Kumar",
	        "email": "gaurav.kumar@example.com",
	        "contact": "9999999999"
	    },
	    "notes": {
	        "address": "Razorpay Corporate Office"
	    },
	    "theme": {
	        "color": "#3399cc"
	    }
	};
	var rzp1 = new Razorpay(options);
	rzp1.on('payment.failed', function (response){
	        alert(response.error.code);
	        alert(response.error.description);
	        alert(response.error.source);
	        alert(response.error.step);
	        alert(response.error.reason);
	        alert(response.error.metadata.order_id);
	        alert(response.error.metadata.payment_id);
	});
	document.getElementById('rzp-button1').onclick = function(e){
	    rzp1.open();
	    e.preventDefault();
	}
</script>