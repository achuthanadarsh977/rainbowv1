<?php

// MAKE THE CONNECTION:

$dbc = @mysqli_connect ("localhost", "rainbow_user","rainbowpassword", "rainbow") OR die ('Could not connect to MySQL: ' .mysqli_connect_error() );
?>
