<?php 

$conn= new mysqli('localhost','root','','voting_db')or die("Could not connect to mysql".mysqli_error($con));

?>

<?php
// Assuming you have a database connection established

// Fetch the count from the database
$query = "SELECT * FROM votes"; // Replace with your actual query
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['voting_opt_id'];
    echo $count;
} else {
    echo 'Error fetching count';
}
?>