<?php
  session_start();
  if(isset($_SESSION['user_email']))
  {
    echo "<script type='text/javascript'>";
    echo "window.location.href = '/';";
    echo "</script>";
  }

  require_once('../../require/dbconfig.php');

  if(isset($_POST['submit'])){

    // $response = $client->scan(array(
    //   'TableName' => 'Users',
    //   'Select' => 'ALL_ATTRIBUTES'
    // ));
  
  
    // $total = count($response['Items']);
  
    // $userid = $total + 1;
  
    // echo $userid;

    // $userid = uniqid();
    // echo $userid;

    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $companyname = $_POST['companyname'];
    $password = $_POST['pass'];

    $responseput = $client->putItem(array(
        'TableName' => 'Users',
        'Item' => array(
            "userId" => array('S'      => uniqid()    ),
            "user_name" => array('S'      => $name      ),
            "user_email" => array('S'      => $email      ),
            "user_mobileno" => array('S'      => $mobileno      ),
            "company_name" => array('S'      => $companyname      ),
            "password" => array('S'      => $password      ),
            "createdAt" => array('S'      =>   date("d/m/Y")    )
        )
    ));

    echo "<script type='text/javascript'>";
    echo "alert('Successfully registerd');";
    echo "window.location.href = 'login.php';";
    echo "</script>";
  }
  
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Petabytz | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  <!-- Bootstrap 3.4.0 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 10px;
  margin-top: 2px;
}

#message p {
  padding: 10px 35px;
  font-size: 15px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <img src="../../logo.png" height="80" width="320">
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="fullname" id="fullname" require>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" id="email" require> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" placeholder="Mobile number" name="mobileno" id="mobileno" require> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Company name" name="companyname" id="companyname" require>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" require>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="confpass" id="confpass" require>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group" id="errodiv">
							<span class="error" style="color:red"></span><br />
						</div>
      <div id="message">
        <h4>Password must contain the following:</h4>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      </div>
      <br>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="registerbutton" name="submit">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script>
  $("#registerbutton").attr("disabled", true);
  $('#errodiv').hide();
  document.getElementById("errodiv").style.display = "none";
  var myInput = document.getElementById("pass");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");

  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    document.getElementById("errodiv").style.display = "block";
  }

  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    document.getElementById("errodiv").style.display = "none";
  }

    // When the user starts to type something inside the password field
  var lcvalidsubmit = false;
  var ucvalidsubmit = false;
  var nvalidsubmit = false;
  var lvalidsubmit = false;
  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
      lcvalidsubmit = true;
    } else {
      lcvalidsubmit = false;
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }
  
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
      ucvalidsubmit = true;
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
      ucvalidsubmit = false;
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
      nvalidsubmit = true;
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
      nvalidsubmit = false;
    }
  
    // Validate length
    if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
      lvalidsubmit = true;
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
      lvalidsubmit = false;
    }

    if(lcvalidsubmit && ucvalidsubmit && nvalidsubmit && lvalidsubmit){
          $("#registerbutton").attr("disabled", false);
					return true;
				}else{
          $("#registerbutton").attr("disabled", true);
					return false;
				}
  }

  var allowsubmit = false;
		$(function(){
      $('#errodiv').show();
			//on keypress 
			$('#confpass').keyup(function(e){
				//get values 
				var pass = $('#pass').val();
				var confpass = $(this).val();
				
				//check the strings
				if(pass == confpass){
          $('#errodiv').show();
					//if both are same remove the error and allow to submit
          $('.error').css('color', 'green');
					$('.error').text('Matched');
          $("#registerbutton").attr("disabled", false);
					allowsubmit = true;
				}else{
          $('#errodiv').show();
					//if not matching show error and not allow to submit
          $('.error').css('color', 'red');
					$('.error').text('Password not matching');
          $("#registerbutton").attr("disabled", true);
					allowsubmit = false;
				}
			});
			
			//jquery form submit
			$('#form').submit(function(){
			
				var pass = $('#pass').val();
				var confpass = $('#confpass').val();
 
				//just to make sure once again during submit
				//if both are true then only allow submit
				if(pass == confpass){
					allowsubmit = true;
				}
				if(allowsubmit){
          $("#registerbutton").attr("disabled", false);
					return true;
				}else{
          $("#registerbutton").attr("disabled", true);
					return false;
				}
			});
		});
</script>

</body>
</html>
