<?php
require_once('mail.php');


function random_string($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return strtoupper($randomString);
}

/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function checkFDUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['calendar_fd_user'])) {
		header('Location: ' . WEB_ROOT . 'login.php');
		exit;
	}
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}

function doLogin()
{
	global $dbConn;
	$name 	= $_POST['name'];
	$pwd 	= $_POST['pwd'];

	$errorMessage = '';

	$sql 	= "SELECT * FROM tbl_users WHERE name = '$name' AND pwd = PASSWORD2('$pwd') AND status = 'active'";
	echo 'sql => '.$sql;
	$result = dbQuery($dbConn, $sql);

	if (dbNumRows($result) == 1) {
		$row = dbFetchAssoc($result);
		$_SESSION['calendar_fd_user'] = $row;
		$_SESSION['calendar_fd_user_name'] = $row['username'];
		header('Location: index.php');
		exit();
	}
	else {
		$errorMessage = 'Invalid username / passsword or User is not active. Please try again or contact to support.';
	}
	return $errorMessage;
}


/*
	Logout a user
*/
function doLogout()
{
	if (isset($_SESSION['calendar_fd_user'])) {
		unset($_SESSION['calendar_fd_user']);
		//session_unregister('hlbank_user');
	}
	header('Location: index.php');
	exit();
}


//student or teacher will register
function registerUser() {
	global $dbConn;
	$name 		= $_POST['name'];
	$pwd 		= $_POST['pwd'];
	$address 	= $_POST['address'];
	$phone 		= $_POST['phone'];
	$email 		= $_POST['email'];
	$type		= $_POST['type'];

	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM tbl_users WHERE name = '$name'";
	$hresult = dbQuery($dbConn, $hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'User with same name already exist. Please try another day.';
		header('Location: register.php?err=' . urlencode($errorMessage));
		exit();
	}
	//$pwd = random_string();
	$sql = "INSERT INTO tbl_users (name, pwd, address, phone, email, type, status, bdate)
			VALUES ('$name', PASSWORD2('$pwd'), '$address', '$phone', '$email', '$type', 'inactive', NOW())";
	dbQuery($dbConn, $sql);

	//send email on registration confirmation
	$bodymsg = "User $name is registered and currently in INACTIVE state. Requesting you to contact admin take further action on user activation.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	//send_email($data);
	header('Location: register.php?msg=' . urlencode('User successfully registered.'));
	exit();
}

function getBookingRecords(){
	global $dbConn;
	$per_page = 10;
	$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;
	$start 	= ($page-1)*$per_page;
	$sql 	= "SELECT u.id AS uid, u.name, u.phone, u.email,
			   r.ucount, r.rdate, r.status, r.comments
			   FROM tbl_users u, tbl_reservations r
			   WHERE u.id = r.uid
			   ORDER BY r.id DESC LIMIT $start, $per_page";
	//echo $sql;
	$result = dbQuery($dbConn, $sql);
	$records = array();
	while($row = dbFetchAssoc($result)) {
		extract($row);
		$records[] = array("user_id" => $uid,
							"user_name" => $name,
							"user_phone" => $phone,
							"user_email" => $email,
							"count" => $ucount,
							"res_date" => $rdate,
							"status" => $status,
							"comments" => $comments);
	}//while
	return $records;
}


function getUserRecords(){
	global $dbConn;
	$per_page = 20;
	$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;
	$start 	= ($page-1)*$per_page;

	$type = $_SESSION['calendar_fd_user']['type'];
	if($type == 'student') {
		$id = $_SESSION['calendar_fd_user']['id'];
		$sql = "SELECT  * FROM tbl_users u WHERE type != 'admin' AND id = $id ORDER BY u.id DESC";
	}
	else {
		$sql = "SELECT  * FROM tbl_users u WHERE type != 'admin' ORDER BY u.id DESC LIMIT $start, $per_page";
	}

	//echo $sql;
	$result = dbQuery($dbConn, $sql);
	$records = array();
	while($row = dbFetchAssoc($result)) {
		extract($row);
		$records[] = array("user_id" => $id,
			"user_name" => $name,
			"user_phone" => $phone,
			"user_email" => $email,
			"type" => $type,
			"status" => $status,
			"bdate" => $bdate
		);
	}
	return $records;
}

function getHolidayRecords() {
	global $dbConn;
	$per_page = 10;
	$page 	= (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;
	$start 	= ($page-1)*$per_page;
	$sql 	= "SELECT * FROM tbl_holidays ORDER BY id DESC LIMIT $start, $per_page";
	//echo $sql;
	$result = dbQuery($dbConn, $sql);
	$records = array();
	while($row = dbFetchAssoc($result)) {
		extract($row);
		$records[] = array("hid" => $id, "hdate" => $date,"hreason" => $reason);
	}//while
	return $records;
}

function generateHolidayPagination() {
	global $dbConn;
	$per_page = 10;
	$sql 	= "SELECT * FROM tbl_holidays";
	$result = dbQuery($dbConn, $sql);
	$count 	= dbNumRows($result);
	$pages 	= ceil($count/$per_page);
	$pageno = '<ul class="pagination pagination-sm no-margin float-right">';
	for($i=1; $i<=$pages; $i++)	{
		$pageno .= "<li class='page-item'><a class='page-link' href=\"?v=HOLY&page=$i\">".$i."</a></li>";
	}
	$pageno .= 	"</ul>";
	return $pageno;
}

function generatePagination(){
	global $dbConn;
	$per_page = 10;
	$sql 	= "SELECT * FROM tbl_users";
	$result = dbQuery($dbConn, $sql);
	$count 	= dbNumRows($result);
	$pages 	= ceil($count/$per_page);
	$pageno = '<ul class="pagination pagination-sm no-margin float-right">';
	for($i=1; $i<=$pages; $i++)	{
	//<li><a href="#">1</a></li>
		//$pageno .= "<a href=\"?v=USER&page=$i\"><li id=\".$i.\">".$i."</li></a> ";
		$pageno .= "<li class='page-item'><a class='page-link' href=\"?v=USER&page=$i\">".$i."</a></li>";
	}
	$pageno .= 	"</ul>";
	return $pageno;
}

?>