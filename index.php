<?php

$message = '';

$connect = new PDO('mysql:host=localhost;dbname=mydatabase','root', '5016028fjk');
session_start();

if (isset($_POST["user_email"]))
{
    $query = "
	SELECT * FROM register_user
		WHERE user_email = :user_email
	";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'user_email'	=>	$_POST["user_email"]
        )
        );
    $count = $statement->rowCount();
    if($count > 0)
    {
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            if($row['user_email_status'] == 'verified')
            {
                //if(password_verify($_POST["user_password"], $row["user_password"]))
                if($row["user_password"] == $_POST["user_password"])
                {
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['user_id'] = $row['register_user_id'];
                    header("location:welcome.php");
                }
                else
                {
                    $message = "Wrong Password";
                }
            }
            else
            {
                $message = "Please First Verify, your email address";
            }
        }
    }
    else
    {
        $message = "Wrong Email Address";
    }
}

?>
<html>
    <head>
        <title>Video Services</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
       </head>
    <body>
        <div class="container">
       
  <div class="row p-4">
          <div class="col-sm">
  <div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    My Account
  </button>
  <div class="dropdown-menu dropdown-menu-right">
       <form class="px-4 py-3" method="post" action="index.php">
           <div class="form-group">
               <h4>Login</h4>
           </div>
           
    <div class="form-group">
      <label for="validationDefault01">Email</label>
      <input type="email" class="form-control" name="user_email" id="validationDefault01" placeholder="Email Address" required>
    </div>
    <div class="form-group">
      <label for="validationDefault02">Password</label>
      <input type="password" class="form-control" name="user_password" id="validationDefault02" placeholder="Password" required>
    </div>
    <div class="form-group">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div>
    </div>
    <div class="form-group">
		<input type="submit" name="login" value="Login" class="btn btn-info" />
	</div>
   <!-- 
    <button type="submit" class="btn btn-primary">Login</button>
    -->
  </form>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="signup.php">Don't have an account? Sign Up</a>
  <a class="dropdown-item" href="#">Forgot password?</a>
</div>
  </div>
    </div>
    <div class="col-sm">
        <img src="assets/batman.jpg" alt="" width="256" height="256">
    </div>
    <div class="col-sm">
      <img src="assets/fast.jpg" alt="" width="256" height="256">
    </div>
    <div class="col-sm">
      <img src="assets/panther.jpg" alt="" width="256" height="256">
    </div>
  </div>
            <br>
   <div class="row">
           <div class="col-sm">
        <h5><font color="red"><?php echo $message?></font></h5>
    </div>
    <div class="col-sm">
      <img src="assets/avengers.jpg" alt="" width="256" height="256">
    </div>
    <div class="col-sm">
      <img src="assets/widow.png" alt="" width="256" height="256">
    </div>
    <div class="col-sm">
      <img src="assets/intern.jpg" alt="" width="256" height="256">
    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
