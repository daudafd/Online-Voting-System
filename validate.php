<?php
include 'dbconnect.php';

    session_start(); //starts the session
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = mysqli_query($conn, "SELECT * from users WHERE username='$username'"); //Query the users table if there are matching rows equal to $emailaddress
	$exists = mysqli_num_rows($query); //Checks if emailaddress exists
	
	$table_username = "";
	$table_password = "";
	
	if($exists > 0) //IF there are no returning rows or no existing emailaddress
	{
		while($row = mysqli_fetch_assoc($query)) //display all rows from query
		{
			$table_username = $row['username']; // the first emailaddress row is passed on to $table_users, and so on until the query is finished
			$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
			$table_usertype = $row['type']; // the first usertype row is passed on to $table_usertype, and so on until the query is finished
		}
		if(($username == $table_username) && ($password == $table_password)) // checks if there are any matching fields
		{
			 if($usertype == '1')
				{
					$_SESSION['username'] = $username; //set the emailaddress in a session. This serves as a global variable
 					$_SESSION['type'] = $usertype; //set the emailaddress in a session. This serves as a global variable
					header("location: home.php"); // redirects the user to the authenticated home page
				}  
		
		else if($usertype == '2')
				{
					$_SESSION['username'] = $username; //set the emailaddress in a session. This serves as a global variable
 					$_SESSION['type'] = $usertype; //set the emailaddress in a session. This serves as a global variable
					header("location: voting.php"); // redirects the user to the authenticated home page
				}  
		}
		else
		{
			Print '<script>alert("Incorrect Password or usertype!");</script>'; //Prompts the user
			Print '<script>window.location.assign("index.php");</script>'; // redirects to index.php
		}
	}
	else
	{
		Print '<script>alert("Incorrect emailaddress!");</script>'; //Prompts the user
		Print '<script>window.location.assign("index.php");</script>'; // redirects to index.php
	}
?>