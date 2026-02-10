<?php 


// ********************************** //
// ************ SITE-WIDE CONSTANTS************ //
$host=$_SERVER['SERVER_NAME'];

if($host=='localhost')
{
//LIVE=FALSE (THE SITE IS OFFLINE)
//LIVE=TRUE (THE SITE IS ONLINE)
define('LIVE', FALSE);// 
define('EMAIL', 'myemail@myemail.com');
// SITE URL (BASE FOR ALL REDIRECTIONS):
define ('SITE_URL', 'http://localhost/rainbow/');
// LOCATION OF YOUR MYSQL CONNECTION SCRIPT:
define ('MYSQL', 'mysqli_rainbow_local.php');
}

else
{ 
define('LIVE', TRUE);
define('EMAIL', 'myemail@myemail.com');
// SITE URL (BASE FOR REDIRECTIONS):
define ('SITE_URL', 'http://www.rainbow.com/');
// LOCATION OF YOUR MYSQL CONNECTION SCRIPT:
define ('MYSQL', '../rainbow.com/connect/mysqli_rainbow_live.php');//YOU WILL CREATE THIS FILE FOR YOUR LIVE SITE

}


