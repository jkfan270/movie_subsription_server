<?session_start();
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
<title>Movie Details</title>
</head>
<body>

<div class="container">


<?php

if (isset($_GET['movie_id']))
{
  $movies = $_GET['movie_id'];
}

        $api_key = "e991f0ad89e379767dace3a2cb76b61c";    

        $url = "https://api.themoviedb.org/3/movie/$movies?api_key=$api_key";
        $myobj = json_decode(geturl($url));

        $img = $myobj->poster_path;
        $imgurl = "https://image.tmdb.org/t/p/w500".$img;

        
        $videourl = "https://api.themoviedb.org/3/movie/$movies?api_key=$api_key&append_to_response=videos";
        $myobj2 = json_decode(geturl($videourl));

        $key = $myobj2->videos->results[0]->key;
	$youtubeUrl = "https://www.youtube.com/embed/$key";
  

        echo "<div>";
	 echo "<p>";
        echo  '<a href="https://fanj.ursse.org/mySub.php"> <<< Go Back to My Subscription </a>';
        echo "</p>";

        echo "<p class='font-weight-bold'>".$myobj->title."</p>";
        echo "<p>";
        echo  '<a href=" https://fanj.ursse.org/unsubscribe.php?movie_id='.$movies.'" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Click to Unsubscribe </a>';
        echo "</p>";
        echo '<img src = "'.$imgurl.'" width = "300"  height = "300">';



        echo "<p class='font-weight-bold'>Overview:</p>";
	    echo "<p>".$myobj->overview."</p>";


       echo "<p class='font-weight-bold'>Genres:</p>";
       echo "<p>"; echo $myobj->genres[0]->name."  & "; echo $myobj->genres[1]->name." & "; echo $myobj->genres[2]->name."  </p>";

       echo "<p class='font-weight-bold'>Popularity:</p>";
        echo "<p>".$myobj->popularity."</p>";



        echo "<p class='font-weight-bold'>Budget:</p>";
        echo "<p>".$myobj->budget."</p>";

      
        echo "<p class='font-weight-bold'>Revenue:</p>";
        echo "<p>".$myobj->revenue."</p>";

        echo "<p class='font-weight-bold'>Release Date:</p>";
        echo "<p>".$myobj->release_date."</p>";
        
       echo "<p class='font-weight-bold'>Run Time:</p>";
       echo "<p>".$myobj->runtime."</p>";

       echo "<p class='font-weight-bold'>Status:</p>";
       echo "<p>".$myobj->status."</p>";

       echo "<p class='font-weight-bold'>Tagline:</p>";
       echo "<p>".$myobj->tagline."</p>";
       
       echo "<p class='font-weight-bold'>Original_language:</p>";
       echo "<p>".$myobj->original_language."</p>";

       echo "<p class='font-weight-bold'>Production Companies:</p>";
       echo "<p>"; echo $myobj->production_companies[0]->name."   &"; echo $myobj->production_companies[1]->name."   &"; echo $myobj->production_companies[2]->name."  ";
       echo "</p>";
    

       echo "<p class='font-weight-bold'>Movie Trailer:</p>";
	
	   echo "<p>";
        echo '<embed type="video/webm" src="'.$youtubeUrl.'" width="960" height="540"  frameborder="0" allowfullscreen>';
        echo "</p>";
        echo "</div>";

?>

</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>