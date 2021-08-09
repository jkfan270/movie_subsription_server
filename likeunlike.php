<?php
session_start();

$con=mysqli_connect("localhost","root","5016028fjk","mydatabase");

$userid = $_SESSION['user_id'];
$postid = $_POST['movie_id'];
$type = $_POST['type'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM sub_unsub WHERE movie_id=".$postid." and user_id=".$userid;

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];


if($count == 0){
    $insertquery = "INSERT INTO sub_unsub(user_id,movie_id,type) values(".$userid.",".$postid.",".$type.")";
    mysqli_query($con,$insertquery);
}else {
    $updatequery = "UPDATE sub_unsub SET type=" . $type . " where user_id=" . $userid . " and movie_id=" . $postid;
    mysqli_query($con,$updatequery);
}


$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);
