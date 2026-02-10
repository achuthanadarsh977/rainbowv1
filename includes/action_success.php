
<?php
	if(isset($_SESSION['move_success']) && $_SESSION['move_success']==1)
	{
	$success[]='Move successful';
	unset($_SESSION['move_success']);

	}
	if(isset($_SESSION['delete_success']) && $_SESSION['delete_success']==1)
	{
	$success[]='Delete successful';
	unset($_SESSION['delete_success']);

	}
	

	?>