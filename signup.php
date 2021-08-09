<?php
$message = '';

$connect = new PDO('mysql:host=localhost;dbname=mydatabase','root', '5016028fjk');
session_start();


if (isset($_POST["register"]))
{
    /*
    $connect = mysqli_connect("localhost","root","5016028fjk","mydatabase",3306);
    if(!$connect){
        echo '<label class="text-success">test1</label>';
    echo "Failed";
    }
*/

//mysqli_select_db($connect,"mydatabase");

$query = "SELECT * FROM register_user WHERE user_email = :user_email";


$statement = $connect->prepare($query);
$statement->execute(
    array(
        ':user_email'	=>	$_POST['user_email']
    )
    );
$no_of_row = $statement->rowCount();


if($no_of_row > 0)
{
    $message = "Email Already Exits";
}

else
{
    $user_activation_code = md5(rand());
    $insert_query = "
		INSERT INTO register_user
		(user_name, user_email, user_password, user_activation_code, user_email_status)
		VALUES (:user_name, :user_email, :user_password, :user_activation_code, :user_email_status)
		";
    $statement = $connect->prepare($insert_query);
    $statement->execute(
        array(
            ':user_name'			=>	$_POST['user_name'],
            ':user_email'			=>	$_POST['user_email'],
            ':user_password'		=>	$_POST['user_password'],
            ':user_activation_code'	=>	$user_activation_code,
            ':user_email_status'	=>	'not verified'
        )
        );
    $result = $statement->fetchAll();
    if(isset($result))
    {
        $base_url = "https://fanj.ursse.org/email_verification.php/";  //change this baseurl value as per your file path
        $mail_body = "
			<p>Hi ".$_POST['user_name'].",</p>
			<p>Thanks for Registration.
			<p>Please Open this link to verified your email address - ".$base_url."email_verification.php?activation_code=".$user_activation_code."
			";
        require 'class/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();								//Sets Mailer to send message using SMTP
        $mail->Host = 'localhost';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = '25';								//Sets the default SMTP server port
        $mail->SMTPAuth = false;							//Sets SMTP authentication. Utilizes the Username and Password variables
        //$mail->Username = 'jkfan270@gmail.com';					//Sets SMTP username
        //$mail->Password = '5016028fjk';					//Sets SMTP password
        $mail->SMTPSecure = '';							//Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = 'fanj@fanj.ursse.org';			//Sets the From email address for the message
        $mail->FromName = 'Video Services';					//Sets the From name of the message
        $mail->AddAddress($_POST['user_email'], $_POST['user_name']);		//Adds a "To" address
        $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);							//Sets message type to HTML
        $mail->Subject = 'Email Verification';			//Sets the Subject of the message
        $mail->Body = $mail_body;							//An HTML or plain text message body
        
        if($mail->Send())								//Send an Email. Return true on success or false on error
        {
            $message = "Register Done, Please check your Email";
        }
    }
}
}


?>
<html>
    <head>
        <title>Signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
       </head>
    <body>
     <div class="container">
         
  <div class="row">
      <div class="col-sm"></div>
          <div class="col-sm">
          <div class="menu">
       <form class="px-4 py-3" method="post" id="register_form" action="signup.php" enctype="multipart/form-data">
        <h1>Sign Up</h1> 
        <h5><font color="red"><?php echo $message?></font></h5>
    <div class="form-group">
      <label for="validationDefault01">Username</label>
      <input type="text" class="form-control" name="user_name" id="validationDefault01" placeholder="Username" required>
    </div>
        <div class="form-group">
      <label for="validationDefault02">Email</label>
      <input type="text" class="form-control" name="user_email" id="validationDefault02" placeholder="Email Address" required>
    </div>
    <div class="form-group">
      <label for="validationDefault03">Password</label>
      <input type="password" class="form-control" name="user_password" id="validationDefault03" placeholder="Password" required>
    </div>
    <!--
    <button type="submit" class="btn btn-primary">Sign Up</button>
    -->
    <div class="form-group">
	<input type="submit" name="register" id="register" value="Register" class="btn btn-info" />
	</div>
  </form>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="index.php">Already have an account? Login</a>
</div>
            </div>
      <div class="col-sm"></div>
  </div>
     </div>
        
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
