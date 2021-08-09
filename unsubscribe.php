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
echo "Error!";
}


    $conn=mysqli_connect("localhost","root","5016028fjk","mydatabase");

   $sql = "DELETE FROM movies WHERE movie_id='$movie_id' AND subscriber ='$user'";
   mysqli_query($conn,$sql);

   echo mysqli_error($conn);
      
   sleep(1);
   header('Location: https://fanj.ursse.org/mySub.php');


?>