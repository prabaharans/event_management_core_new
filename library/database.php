<?php
require_once 'config.php';

$dbConn = mysqli_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());
mysqli_select_db($dbConn, $dbName ) or die('Cannot select database. ' . mysqli_error());

function dbQuery($dbConn, $sql)
{
	$result = mysqli_query($dbConn, $sql) or die(mysqli_error());
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;
	return mysqli_affected_rows($dbConn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysqli_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysqli_fetch_assoc($result);
}

function dbFetchRow($result)
{
	return mysqli_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysqli_free_result($result);
}

function dbNumRows($result)
{
	return mysqli_num_rows($result);
}

function dbSelect($dbName)
{
	return mysqli_select_db($dbConn, $dbName);
}

function dbInsertId()
{
	return mysqli_insert_id();
}
?>