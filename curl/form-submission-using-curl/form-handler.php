<?php
/*
 * This script will handle the form data posted by cURL
 */
/*
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$email = $_POST['email'];


$response = "Received from PHP via cURL:<br /><br />
First Name: $first_name<br />
Last Name: $last_name<br />
Password: $password<br />
Email: $email<br />
";
*/
$response = array(
	"info" => "Received from PHP via cURL",
	"f_name" => $first_name,
	"l_name" => $last_name,
	"pass" => $password,
	"email" => $email, 
);


echo json_encode($response);
?>
