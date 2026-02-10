<?php 
	$page_title='Trash';
	include('includes/inside_headmaster.php');
	include('includes/action_success.php');
	?>
	<script src="includes/js/jresources.js"> 
	</script>
    <div class="row"><div class="large-12 columns">
	<h2>Trash</h2>

    </div></div>
	

	<?php
	include('includes/contacts_trash_count.php');
	?>
	
<?php


   $q = "SELECT id,fullname,email,phone,address FROM cms WHERE ($tenant AND status='del')";
   $r = mysqli_query($dbc,$q);
	if(@mysqli_num_rows($r) > 0)

	{ // IF ONE OR MORE ROWS ARE RETURNED DO FOLLOWING

    echo'<div class="row"><div class="large-12 columns">';
	echo'<table width="100%" class="trash_table"><th width="2%" align="left"></td><th width="23%" align="left">Name</th><th width="17%" align="left">Phone</th><th width="22%" align="left">Email</th><th width="36%" align="left">Address</th>';
	echo'<form action="" method="POST" name="checkboxesform">';
	$i=0; //INITIALIZE COUNTER FOR SERIAL NUMBER OF CONTACTS
	while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
	{

	//INCASE THE LENGTH OF THE NAME OR PHONE IS TOO LONG
	if(strlen($row['fullname'])>20){
	$row['fullname']=mb_substr($row['fullname'],0,20).'...';
	}
	if(strlen($row['address'])>35){
	$row['address']=mb_substr($row['address'],0,40).'...';
	}

	if(strlen($row['email'])>20){
	$row['email']=mb_substr($row['email'],0,11).'...';
	}


	if(strlen($row['phone'])>15){
	$row['phone']=mb_substr($row['phone'],0,11).'...';
	}
	if(empty($row['phone'])){ $row['phone']= '----';}
	if(empty($row['address'])){ $row['address']= '----';}



echo '<tr>
	<td width="2%" ><input type="checkbox"  name="checkbox[]" value="'. $row['id'].'"></td>
	<td class="red">'.$row['fullname'].'</td>
	
	<td>'. $row['phone'].'</td>
	<td>'. $row['email'].'</td>

	<td>'.$row['address'] .'</td>
	</tr>';
	}


	echo'</table>';


	//RESTORE CONTACTS

	if(isset($_POST['restore']))
	{
	if(isset($_POST['checkbox']))
	{
	$checkbox=$_POST['checkbox'];
	$count=count($_POST['checkbox']);
	for($i=0;$i<$count;$i++)
	{
	$restore_id = $checkbox[$i];
	$sql = "UPDATE cms SET status='active' WHERE (id=$restore_id AND $tenant)";
	$delete_result = mysqli_query($dbc,$sql);
	}
	if ($delete_result) 
	{
	$sql2 = "UPDATE group_members SET status='active' WHERE (fkcms_cid=$restore_id AND $tenant)";
	$delete_result2 = mysqli_query($dbc,$sql2);


	$_SESSION['move_success']=1;      //CONTACTS SUCCESSFULLY MOVED OUT OF TRASH
	header("Location:contacts.php");	// IF SUCCESSFUL REDIRECT TO CONTACTS PAGE
	} 
	else 
	{ 
	$error[]= 'Restore NOT successful .';
     //echo mysqli_error($dbc);
	}
	}//CLOSE IF ISSET POST CHECKBOX
	}// CLOSE IF ISSET POST DELETE



	//DELETE CONTACTS

	if(isset($_POST['delete']))
	{
	if(isset($_POST['checkbox']))
	{
	$checkbox=$_POST['checkbox'];
	$count=count($_POST['checkbox']);
	for($i=0;$i<$count;$i++)
	{
	$del_id = $checkbox[$i];
	$sql = "UPDATE cms SET status='permadel' WHERE (id=$del_id AND $tenant)";
	$delete_result = mysqli_query($dbc,$sql);
	}
	if ($delete_result) 
	{
	$_SESSION['delete_success']=1;		//WE USE THIS VARIABLE TO ECHO A SUCCESS MESSAGE
	header("Location:trash_contacts.php");	// IF SUCCESSFUL REDIRECT TO CONTACTS PAGE
	} 
	else 
	{ 
	$error[]= 'Delete NOT successful .';
     //echo mysqli_error($dbc);
	}
	}//CLOSE IF ISSET POST CHECKBOX
	}// CLOSE IF ISSET POST DELETE


	echo'<div class="row"><div class="large-12 columns">
	<div class="medium-2 large-2 columns">
	<input type="submit" name="restore"  class="thin radius button" value="Restore">
	</div>
    <div class="medium-8 large-8 columns">&nbsp;</div>
	<div class="medium-2 large-2 columns">
	<input type="submit" name="delete"  class="thin radius button" value="Delete" onclick="return confirmdelete();">
	</div></div></div>
	<div class="row"><div class="large-12 columns">
	<div class="medium-10 large-10 columns">
		&nbsp;

	</div>
	<div class="medium-2 large-2 columns">
		<input type="checkbox" name="checkboxall"  value="yes" onClick="Check(document.checkboxesform.checkbox)"><span class="small_spacing">Select all</span>

	</div>
	</div></div>




</form>';
	}
	elseif(mysqli_num_rows($r)==0)
	{
	$notify[]='No contacts here';
	}
	else
	{
	$error[]='An error has occured. We apologize for any incovenience';
	exit;
	}


	include('includes/alert.php');
	include('includes/footer.html');

	?>
	