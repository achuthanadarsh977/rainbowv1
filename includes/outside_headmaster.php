<?php

//START OUT BUFFERING
ob_start();

//START SESSION

session_start();

//WE WILL USE ARRAYS TO STORE ALL SUCCESS,NOTIFATION AND ERROR MESSAGES. 

$success=array();
$notify=array();
$error=array();

//INCLUDE THE CONFIG FILE WHICH HOLDS THE SITE WIDE CONSTANTS
include('includes/config.inc.php');


//INCLUDE THE FUNCTIONS FILE TO HANDLE SOME ROUTINE TASKS LIKE SANITIZING INPUT ETC.
include('includes/myfunctions.php');


//CHECK IF THERE IS AN ACTIVE USER SESSION SO THE USER CAN STAY LOGGED IN
if (isset($_SESSION['tenant_id']))  
{

//THE USER SHOULD NOT BE ABLE TO ACCESS THE SIGN IN FORM WHEN HE IS STILL LOGGED IN
//IF THERE IS AN ACTIVE USER SESSION, REDIRECT THE USER .
$redirect = SITE_URL . 'contacts.php'; //

//CLEAN THE BUFFER
ob_end_clean( ); 

//REDIRECT THE USER
header("Location: $redirect");

//EXIT THE SCRIPT
exit;
}

//GET THE DATABASE CONNECTION
//MYSQL BELOW IS THE CONSTANT THAT STORES THE PATH TO THE DATABASE CONNECTION FILE. SEE CONFIG.INC.PHP IN INCLUDES FOLDER

if(file_exists(MYSQL))
{
require(MYSQL);
}
else{

 include('includes/404.php');
 exit;
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
<!-- THE FAVICON-->
<link rel="shortcut icon" href="css/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="css/images/favicon.ico" type="image/x-icon">	
<!-- GOOGLE FONT-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300,300italic' rel='stylesheet' type='text/css'>
<!-- PRINT THE TITLE OF PAGE IF $PAGE_TITLE IS SET-->

<title>
<?php
if(isset($page_title))
{
echo $page_title;
}
?>
</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- FOUNDATION 5 STYLESHEET-->
<link rel="stylesheet" href="css/foundation.css" type="text/css" media="all" />

<!--<YOUR OWN SITE-WIDE STYLESHEET  />-->

<link rel="stylesheet" href="css/custom.css" type="text/css" media="all" />


</head>
<body>
<script src="js/vendor/jquery.js"></script>
<script src="js/modernizr.js"></script>
<div class="row">
<div class="large-12 columns">
<h1><a href="index.php">RAINBOW</a></h1>
</div></div>