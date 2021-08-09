<?php
session_start();
?>


<?php


if (isset($_GET['movie_id']))
{
  $movie_id = $_GET['movie_id'];
  $user = $_SESSION['user_name'];
}
else
{
echo "wrong";
}


    $conn=mysqli_connect("localhost","root","5016028fjk","mydatabase");

   $sql = " INSERT INTO movies (movie_id, subscriber) VALUES ('$movie_id', '$user')";
    mysqli_query($conn,$sql);

   echo mysqli_error($conn);
      
   sleep(1);
   header('Location: https://fanj.ursse.org/welcome.php');


?>