<?php

require_once 'Booking.php';
require_once '../library/config.php';
require_once '../library/mail.php';

$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';

switch($cmd) {

	case 'book':
		bookCalendar();
	break;

	case 'holiday':
		addHoliday();
	break;

	case 'hdelete':
		deleteHoliday();
	break;

	case 'calview':
		calendarView();
	break;

	case 'regConfirm':
		regConfirm();
	break;

	case 'delete':
		regDelete();
	break;

	case 'user':
		userDetails();
	break;

	default :
	break;
}

function addHoliday() {
	global $dbConn;
	$date 		= $_POST['date'];
	$reason 	= $_POST['reason'];

	$errorMessage = '';

	$sql 	= "SELECT * FROM tbl_holidays WHERE date = '$date'";
	$result = dbQuery($dbConn, $sql);

	if (dbNumRows($result) > 0) {
		$errorMessage = 'Holiday already exist in record.';
		header('Location: ../views/?v=HOLY&err=' . urlencode($errorMessage));
		exit();
	}
	else {
		$sql = "INSERT INTO tbl_holidays (date, reason, bdate)
				VALUES ('$date', '$reason', NOW())";
		dbQuery($dbConn, $sql);
		$msg = 'Holiday successfully added on calendar.';
		header('Location: ../views/?v=HOLY&msg=' . urlencode($msg));
		exit();
	}
}

function bookCalendar() {
	global $dbConn;
	$name 		= $_POST['name'];
	$userId		= (int)$_POST['userId'];
	$address 	= $_POST['address'];
	$phone 		= $_POST['phone'];
	$email 		= $_POST['email'];
	$rdate		= $_POST['rdate'];
	$rtime		= $_POST['rtime'];
	$bkdate		= $rdate. ' '. $rtime;
	$ucount		= $_POST['ucount'];

	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM tbl_holidays WHERE date = '$rdate'";
	$hresult = dbQuery($dbConn, $hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'You can not book any event on Holiday. Please try another day.';
		header('Location: ../views/?v=DB&err=' . urlencode($errorMessage));
		exit();
	}

	/*
	$sql = "INSERT INTO tbl_users (name, address, phone, email, bdate)
			VALUES ('$name', '$address', '$phone', '$email', NOW())";
	dbQuery($dbConn, $sql);
	$insert_id = dbInsertId();
	*/

	$sql = "INSERT INTO tbl_reservations (uid, ucount, rdate, status, comments, bdate)
			VALUES ($userId, $ucount, '$bkdate', 'PENDING', '', NOW())";
	dbQuery($dbConn, $sql);

	//send email on registration confirmation
	$bodymsg = "User $name booked the date slot on $bkdate. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => 'tousifkhan510@gmail.com', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	//send_email($data);
	header('Location: ../index.php?msg=' . urlencode('User successfully registered.'));
	exit();
}

function regConfirm() {
	global $dbConn;
	$userId		= $_GET['userId'];
	$action 	= $_GET['action'];
	$stat		= ($action == 'approve') ? 'APPROVED' : 'DENIED';

	$sql		= "UPDATE tbl_reservations SET status = '$stat' WHERE uid = $userId";
	dbQuery($dbConn, $sql);

	//send email now.
	$data = array();

	header('Location: ../views/?v=DB&msg=' . urlencode('Reservation status successfully changed.'));
	exit();
}

function regDelete() {
	global $dbConn;
	$userId	= $_GET['userId'];
	$sql1	= "DELETE FROM tbl_reservations WHERE uid = $userId";
	dbQuery($dbConn, $sql1);
	$sql2	= "DELETE FROM tbl_users WHERE id = $userId";
	dbQuery($dbConn, $sql2);

	header('Location: ../views/?v=LIST&msg=' . urlencode('User record successfully deleted.'));
	exit();
}

function deleteHoliday() {
	global $dbConn;
	$holyId	= $_GET['hId'];
	$dsql	= "DELETE FROM tbl_holidays WHERE id = $holyId";
	dbQuery($dbConn, $dsql);
	header('Location: ../views/?v=HOLY&msg=' . urlencode('Holiday record successfully deleted.'));
	exit();
}

function calendarView() {
	global $dbConn;
	$start 	= $_POST['start'];
	//$sdate	= date("Y-m-d\TH:i\Z", time($start));
	$end 	= $_POST['end'];
	//$edate	= date("Y-m-d\TH:i\Z", time($end));
	$bookings = array();
	$sql	= "SELECT u.name AS u_name, u.id AS user_id, r.rdate, r.status
			   FROM tbl_users u, tbl_reservations r
			   WHERE u.id = r.uid
			   AND (r.rdate BETWEEN '$start' AND '$end')";
	//AND r.status = 'APPROVED'
	$result = dbQuery($dbConn, $sql);
	while($row = dbFetchAssoc($result)) {
		extract($row);
		$book = new Booking();
		$book->title = $u_name;
		$book->start = $rdate;
		$bgClr = '#f39c12';//pending
		if($status == 'DENIED') {$bgClr = '#ff0000';}
		else if($status == 'APPROVED') {$bgClr = '#00cc00';}
		$book->backgroundColor = $bgClr; //#7FFF00 -> green, #ff0000 red, #f39c12 -> pending
		$book->borderColor = $bgClr;
		$book->url = WEB_ROOT . 'views/?v=USER&ID='.$user_id;
		$bookings[] = $book;
	}
	//execute SQLs to get the Holiday blocking days List within the limit of start, end date;
	$hsql	= "SELECT * FROM tbl_holidays
			   WHERE (date BETWEEN '$start' AND '$end')";
	$hresult = dbQuery($dbConn, $hsql);
	while($hrow = dbFetchAssoc($hresult)) {
		extract($hrow);
		$b = new Booking();
		$b->block = true;
		$b->title = $reason;
		$b->start = $date;
		$b->allDay = true;
		$b->borderColor = '#F0F0F0';
		$b->className = 'fc-disabled';
		$bookings[] = $b;
	}//while
	echo json_encode($bookings);
}

function userDetails() {
	global $dbConn;
	$userId	= $_GET['userId'];
	$hsql	= "SELECT * FROM tbl_users WHERE id = $userId";
	$hresult = dbQuery($dbConn, $hsql);
	$user = array();
	while($hrow = dbFetchAssoc($hresult)) {
		extract($hrow);
		$user['user_id'] = $id;
		$user['address'] = $address;
		$user['phone_no'] = $phone;
		$user['email'] = $email;
	}//while
	echo json_encode($user);
}


?>