<?php
session_start();
?>

<?php
function geturl($url)
{
      $headerArray = array("Content-type:application/json;","Accept:application/json");
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch,CURLOPT_HEADER,0);

      $output = curl_exec($ch);
      echo curl_error($ch);
      curl_close($ch);
    //$output = json_decode($output,true);
      return $output ;
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>My Subscription Page</title>
</head>
<body>

<div class="container">


<?php

    echo '<a href = "https://fanj.ursse.org/welcome.php"> <<< Back to Movie List Page </a>';
    echo "<h4>";
    echo "Subscribed Movies:";
    echo "</h4>";

    $conn=mysqli_connect("localhost","root","5016028fjk","mydatabase");

     if(!$conn){
        echo 'Connection error' .mysqli_connect_error();
     }

     echo "<div class='row'>";
if (isset($_SESSION['user_name']))
{

      $user =  $_SESSION['user_name'];
      
      $sql ="SELECT movie_id FROM movies WHERE subscriber = '$user'";


      $result = mysqli_query($conn,$sql);

      $api_key = "e991f0ad89e379767dace3a2cb76b61c";

        
     while( $movie_id = mysqli_fetch_assoc($result))
     {
         $movies =  implode("",$movie_id);
               
        
        $url = "https://api.themoviedb.org/3/movie/$movies?api_key=$api_key";
        $myobj = json_decode(geturl($url));
        
        $img = $myobj->poster_path;
        $imgurl = "https://image.tmdb.org/t/p/w500".$img;
        //echo  $imgurl;
        
            echo "<div class='col-sm'>";
                echo "<p class='font-weight-bold'>".$myobj->title."</p>";
                echo '<img src = "'.$imgurl.'" width = "200"  height = "200">';
                echo "<br />";
                echo "<p>";
                echo  '<a href=" https://fanj.ursse.org/unsubscribe.php?movie_id='.$movies.'" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Unubscribe</a>';
                echo  '<a href=" https://fanj.ursse.org/details.php?movie_id='.$movies.'" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Click for details</a>';
                echo "</p>";
            echo "</div>";
        

     }

}
echo "</div>";
?>

</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
