<!DOCTYPE html>
<html>
<head>
	<title>Send SMS from PHP using textlocal</title>
	
</head>
<style>
    
button{
    
    background-color: lightgrey;
    color:black;
    height: 38px;
    width: 123px;
     font-family: "Gotham A","Gotham B",sans-serif;
    font-size: 22px;
    font-weight: 700;
    border-radius: 10px;
    border:1px solid grey;
    
    
}
button:hover{
    
    background-color: black;
    color:white;
    
}
    
.form label{
    font-size: 22px;
    font-weight: 700;
    font-family: "Gotham A","Gotham B",sans-serif;
    
}

.form input{
    
height: 36px;
    
width: 504px;
    
font-size:16px;
    
background-color: lightgrey;
    
border-radius: 10px;

border:1px solid grey;
}
    
.h1{

    color: black;
    font-family: "Gotham A","Gotham B",sans-serif;
    font-weight: 500;
    line-height: 1.2;
    margin: 0 0 20px;
    font-size: 21px;
    letter-spacing: 12px;
    word-spacing: 27px;
    text-align: center;
    
}

</style>
<body>
<!--<h1>Verify the otp to complete the payment</h1>-->
<div class="form">

<hr>
	<div class="row">
	<div class="col-md-9 col-md-offset-2">
		<?php
			if(isset($_POST['sendopt'])) {
				require('textlocal.class.php');
				require('credential.php');

				$textlocal = new Textlocal(false, false, API_KEY);

                $numbers = array($_POST['mobile']);

				$sender = 'TXTLCL';
				$otp = mt_rand(10000, 99999);
				$message = " Hello  " . $_POST['uname'] . "  This is your OTP : " . $otp;

				try {
				    $result = $textlocal->sendSms($numbers, $message, $sender);
				    setcookie('otp', $otp);
				    echo "OTP successfully sent..";
                    
				} catch (Exception $e) {
				    die('Error: ' . $e->getMessage());
				}
			}

			if(isset($_POST['verifyotp'])) { 
				$otp = $_POST['otp'];
				if($_COOKIE['otp'] == $otp) {
					echo "Your payment has been successfully completed!";
                     
				} else {
					echo "Please enter correct otp.";
                    header("Location: destinations.html");
				}
			}
		?>
	</div>
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="uname" >Name:</label><br><br>
                    <input type="text" class="form-control" id="uname" name="uname" value="" maxlength="10" placeholder="Enter your name" required=""><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="mobile">Mobile:</label><br><br>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="" maxlength="10" placeholder="Enter valid mobile number" required=""><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="sendopt" class="btn btn-lg btn-success btn-block">Send </button><br><hr>
                </div>
            </div>
            </form>
            <form method="POST" action="" onsubmit="destination.html">
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="otp">Enter OTP:</label><br><br>
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" maxlength="5" required=""><br><br>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="verifyotp" class="btn btn-lg btn-info btn-block">Verify</button>
                </div>
            </div>
        </form>
	</div>
</div>
    </div>
</body>
</html>
