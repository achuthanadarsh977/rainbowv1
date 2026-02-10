<div class="row"><div class="large-12 columns">
<?php


/* COUNT NO OF RECORDS
	......................................*/
	 $q = "SELECT COUNT(id) FROM cms WHERE $tenant AND status='active'";
	 $r = @mysqli_query ($dbc, $q);
	 list($records)=mysqli_fetch_row($r);
	 if($records<1)
	 { $records=0;}


echo '<div class="medium-2 large-2 columns"><img src="css/images/thumb_contact.png" alt=""/>&nbsp;Contacts&nbsp;('.$records.')


</div>';

echo '<div class="medium-8 large-8 columns">&nbsp;</div>';



/* COUNT NO OF RECORDS IN TRASH
	......................................*/

	$tq = "SELECT COUNT(id) FROM cms WHERE $tenant AND status='del'";
	$tr = @mysqli_query ($dbc, $tq);
	list($trecords)=mysqli_fetch_row($tr);
	  if($trecords<1)
	 { $trecords=0;}
echo '<div class="medium-2 large-2 columns"><img src="css/images/thumb_trashcan_empty.png" alt=""/>&nbsp;<a href="trash_contacts.php">Trash&nbsp;('.$trecords.')</a></div>';


	?>
	</br></br>
    </div></div>

