<?php

//START OUT BUFFERING SO WE DONT GET HEADERS ALREADY SENT ERROR.MAKE SURE IT IS PLACED BEFORE SESSION_START()
ob_start();

//START SESSION

session_start();

//WE WILL USE ARRAYS TO STORE ALL SUCCESS,NOTIFATION AND ERROR MESSAGES. 

$success=array();
$notify=array();
$error=array();

//INCLUDE THE CONFIG FILE WHICH HOLDS THE SITE WIDE CONSTANTS
include('includes/config.inc.php');

//GET THE DATABASE CONNECTION
//MYSQL BELOW IS THE CONSTANT THAT STORES THE PATH TO THE DATABASE CONNECTION FILE. SEE CONFIG.INC.PHP IN INCLUDES FOLDER

if(file_exists(MYSQL))
{
require(MYSQL);
}
else
{
include('includes/404.php');
exit;
}

//INCLUDE THE FUNCTIONS FILE TO HANDLE SOME ROUTINE TASKS LIKE SANITIZING INPUT ETC.

include('includes/myfunctions.php');


//IF THERE IS NO TENANT TOKEN, LOG THE USER OUT
if (!isset($_SESSION['tenant_token']) && !isset($_SESSION['fk_tenant_token'] ) )
{


//BUILD THE REDIRECTION URL
$redirect= SITE_URL . 'index.php'; 

// CLEAN THE BUFFER.
ob_end_clean( ); 

//NOW, REDIRECT THE USER
header("Location: $redirect");

exit; 
}


// SIMPLE WAY TO KEEP TRACK OF USER ACTIONS

if(isset($_SESSION['tenant_email']))
{

$created_by=$_SESSION['tenant_email'];

$last_modified_by=$_SESSION['tenant_email'];

$deleted_by=$_SESSION['tenant_email'];

}



//ASSIGN SESSION VARIABLES TO ORDINARY VARIABLES TO MAKE QUERIES NEATER. WE ARE GOINT TO BE USING THIS NEW VARIABLES IN OUR QUERIES
if(isset($_SESSION['tenant_id']))
{
$tenant_id=$_SESSION['tenant_id'];
}
else
{
$tenant_id=$_SESSION['fk_tenant_id'];
}

//ASSIGN THE VALUE OF THE TENANT TOKEN IN THE SESSION TO $TENANT_TOKEN. ITS SHORTER AND EASIER TO USE

if(isset($_SESSION['tenant_token']))
{
$tenant_token=$_SESSION['tenant_token'][0];

}
else
{
$tenant_token=$_SESSION['fk_tenant_token'];
}


/*WE WOULD USE BOTH THE TENANT ID AND TENANT TOKEN TO IDENTIFY USERS.
LET US STORE IT IN ONE SIMPLE VARIABLE CALLED TENANT TO MAKE QUERIES NEATER
*/
$tenant="fk_tenant_id=$tenant_id AND fk_tenant_token='$tenant_token'";



?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<!-- THE FAVICON-->
<link rel="shortcut icon" href="css/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="css/images/favicon.ico" type="image/x-icon">	

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- GOOGLE FONT-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300,300italic' rel='stylesheet' type='text/css'>
<title><?php if(isset($page_title)){echo $page_title;} ?></title>

<!-- FOUNDATION 5 STYLESHEET-->
<link rel="stylesheet" href="css/foundation.css" />
<link rel="stylesheet" href="css/normalize.css" />

<!--<YOUR OWN SITE-WIDE STYLESHEET />-->
<link rel="stylesheet" href="css/custom.css" />


</head>
<body>
<script src="js/vendor/jquery.js"></script>
<script src="js/modernizr.js"></script>

<div class="row">
<div class="large-12 columns">
<div class="large-8 columns">
<div id="logo">
<?php

echo'<h1><a href="contacts.php">RAINBOW</a></h1>';

?>
</div>

</div>
<div class="large-4 columns">
&nbsp;
</div>

</div></div>

<!-- NAV BAR FOR LOGGED IN USER -->

<div class="row">
<div class="large-12 columns">
<?php

//ECHO GREETING MESSAGE
if(isset($_SESSION['tenant_fullname']))
{
echo 'Welcome,&nbsp'.$_SESSION['tenant_fullname'];
}
else
{
echo 'Welcome,&nbsp'.$_SESSION['tenant_email'];

}
?>

<!-- NAVIGATION -->

<nav class="top-bar" data-topbar>
<ul class="title-area">
<!-- Title Area -->
 <li class="name">
</li>
<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
</ul>
 <section class="top-bar-section">
<!-- Left Nav Sec-->
<ul class="left">
<li><a href="contacts.php" class=""><span class="mybutton">Contacts</span></a></li>

<li class="has-dropdown">
<a href="groups.php" class=""><span class="mybutton">Groups</span></a>
<ul class="dropdown">
<li><a href="add_group.php" class=""><span class="mydropdownbutton">Add group</span></a></li>
</ul>

<li class="has-dropdown">
<a href="settings.php" class=""><span class="mybutton">Account</span></a>
<ul class="dropdown">
<li><a href="settings.php" class=""><span class="mydropdownbutton">Settings</span></a></li>
<li><a href="logout.php" class=""><span class="mydropdownbutton">Logout</span></a></li>

</ul>
</li>
</ul>
</section>
</nav>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.topbar.js"></script>
<script>
$(document).foundation();
</script>

<!--END NAVIGATION-->



</br>

<!--PRINT A BACK BUTTON ON EVERY PAGE FOR EASY NAVIGATION-->

<a href="<?php if(isset($_SERVER['HTTP_REFERER'])){echo $_SERVER['HTTP_REFERER'];}?>" class="thin radius button">Go back</a>

</div>

</div>
<div class="row"><div class="large-12 columns">
	


 <!-- END NAV -->