<?php

require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../library/mail.php';

$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';

switch($cmd) {

	case 'create':
		createUser();
	break;

	case 'change':
		changeStatus();
	break;

	default :
	break;
}

function createUser() {
	global $dbConn;
	$name 		= $_POST['name'];
	$address 	= $_POST['address'];
	$phone 		= $_POST['phone'];
	$email 		= $_POST['email'];
	$type		= $_POST['type'];

	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM tbl_users WHERE name = '$name'";
	$hresult = dbQuery($dbConn, $hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'User with same name already exist. Please try another day.';
		header('Location: ../views/?v=CREATE&err=' . urlencode($errorMessage));
		exit();
	}
	$pwd = random_string();
	$sql = "INSERT INTO tbl_users (name, pwd, address, phone, email, type, status, bdate)
			VALUES ('$name', '$pwd', '$address', '$phone', '$email', '$type', 'active', NOW())";
	dbQuery($dbConn, $sql);

	//send email on registration confirmation
	$bodymsg = "User $name booked the date slot on $bkdate. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	//send_email($data);
	header('Location: ../views/?v=USERS&msg=' . urlencode('User successfully registered.'));
	exit();
}

function changeStatus() {
	global $dbConn;
	$action 	= $_GET['action'];
	$userId 	= (int)$_GET['userId'];


	$sql = "UPDATE tbl_users SET status = '$action' WHERE id = $userId";
	dbQuery($dbConn, $sql);

	//send email on registration confirmation
	$bodymsg = "User $name booked the date slot on $bkdate. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	//send_email($data);
	header('Location: ../views/?v=USERS&msg=' . urlencode('User status successfully updated.'));
	exit();
}
?>