<?php
session_start();

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
<title>Movie List</title>
</head>
<body>

<div class="container">

<?php
if(isset($_SESSION["user_name"]))
{
    echo "<h4>Welcome, logged in as:  " .$_SESSION['user_name']. "</h4>";
    echo "<a href='mySub.php'>My Subscription</a>";
    echo "<br />";
    echo "<a href='logout.php'>Logout</a>";
    echo "<div class='row'>";

    $con=mysqli_connect("localhost","root","5016028fjk","mydatabase");
    

    /*
    $query1 = "SELECT * FROM register_user";
    $result1 = mysqli_query($con,$query1);
    $row1 = mysqli_fetch_array($result1);
    */
    
    $user = $_SESSION["user_name"];
   
    //$query = "SELECT movie_id FROM movies";
    $query = "SELECT moviedb_id FROM moviedb";
    
    $result = mysqli_query($con,$query);
    
    $api_key = "e991f0ad89e379767dace3a2cb76b61c";
    
    while( $movie_id = mysqli_fetch_assoc($result))
    {
        $movies =  implode("",$movie_id);
        
        $s ="SELECT movie_id FROM `movies` where `subscirber` = '$user'";
        $r = mysqli_query($con,$s);
        $temp = 0;
        while ( $checkID = mysqli_fetch_assoc($r))
        {
            if ($checkID['movie_id'] == $movies)
            {
                $temp = 1;
            }
        }
    
        if($temp == 0)
        {
            
            $url = "https://api.themoviedb.org/3/movie/$movies?api_key=$api_key";
            $myobj = json_decode(geturl($url));
            
            $img = $myobj->poster_path;
            $imgurl = "https://image.tmdb.org/t/p/w500".$img;
            //echo  $imgurl;
            echo "<br />";
                echo "<div class='col-sm'>";
                    echo "<p class='font-weight-bold'>".$myobj->title."</p>";
                    echo "<p>";
                    echo "</p>";
                    echo '<img src = "'.$imgurl.'" width = "200"  height = "200">';
                    echo "<br />";
                    echo '<a href=" https://fanj.ursse.org/subscribe.php?movie_id='.$movies.'" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Subscribe</a>';
                echo "</div>";
            
        }
    
        
        ?>

<?php
    }
    echo "</div>";
}
else
{
    echo "<H3>Please Login or Sign up</h3>";
    echo "<a href='index.php'>Login</a> <a href='signup.php'>Signup</a>";
    
}
?>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>