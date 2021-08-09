<?php
$conn = mysqli_connect("52.60.126.120","root","5016028fjk","mydatabase",3306);

if(!$conn){
    echo "Failed";
}
mysqli_select_db($conn,"mydatabase");

$sql = "select * from Employees";

$obj = mysqli_query($conn,$sql);

echo "<center>";
echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>ID</th><th>LastName</th><th>FirstName</th><th>Postion</th>";
while($row = mysqli_fetch_assoc($obj)){
    echo "<tr>";
    echo '<td>'.$row['IDNum'].'</td>';
    echo '<td>'.$row['LastName'].'</td>';
    echo '<td>'.$row['FirstName'].'</td>';
    echo '<td>'.$row['Position'].'</td>';
    echo "</tr>";
}

echo "</table>";
echo "<center>";

mysqli_close($conn);
?>