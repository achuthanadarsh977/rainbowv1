<?php
	
$page_title='Add Contact';
include('includes/inside_headmaster.php');
?>

<!--INCLUDE FILE THAT CONTAINS OUR CUSTOM JAVASCRIPT FUNCTIONS-->
<script src="includes/js/jresources.js"></script>


<div class="row">
<div class="large-12 columns">
<h3>Add contact</h3>

<?php
if(isset($_POST['submit']))
{
//INITIALIZE ALL THE INPUT VARIABLES
$fullname=$company=$jobtitle=$website=$address=$email=$phone='';

//SANITIZE IS A CUSTOM FUNCTION USED FOR SANITIZING USER INPUT. SEE INCLUDES/MYFUNCTIONS.PHP

if(!empty($_POST['fullname']))
{$fullname=sanitize($_POST['fullname']);}
else
{
$error[]='Please enter a name';
}

if(!empty($_POST['phone']))
{$phone=sanitize($_POST['phone']);}

if(!empty($_POST['address']))
{$address=sanitize($_POST['address']);}

if(!empty($_POST['email']))
{
// CHECK FOR A VALID EMAIL ADDRESS USING PHP's INBUILT FILTER VALIDATE EMAIL FUNCTION:
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === $_POST['email']) 
{
$email = mysqli_real_escape_string($dbc,sanitize($_POST['email']));
} 
else 
{
$error[] = 'Please enter a valid email address!';
}
}

if(!empty($_POST['jobtitle']))
{$jobtitle=sanitize($_POST['jobtitle']);}

if(!empty($_POST['company']))
{$company=sanitize($_POST['company']);}

if(!empty($_POST['website']))
{$website=sanitize($_POST['website']);}







  //CHECK IF THE PHONE NUMBER EXISTS FOR THE CURRENT TENANT
if(!empty($phone))
{
$checkphone=@mysqli_query($dbc,"SELECT id FROM cms WHERE phone='$phone' AND phone!=' ' AND phone!='' AND $tenant " );

if(@mysqli_num_rows($checkphone)>0 )
{
//GET THE ID
list($id)=mysqli_fetch_row($checkphone);
mysqli_free_result($checkphone);
$error[]='A contact with this phone number already exists.<a href="view_contact.php?id='.$id.'"><span class="white"><strong> Click here to see this person</strong></a>';
}
}// CLOSE IF NOT EMPTY PHONE

// IF THERE ARE NO ERRORS, PROCEED

if(empty($error))
{

//CREATE A UNIQUE ID FOR THE NEW CONTACT

$last_id=mysqli_query($dbc,"SELECT cms_id FROM cms ORDER BY cms_id DESC LIMIT 1");

//IF THERES NO CONTACT IN THE DATABASE YET
if(@mysqli_num_rows($last_id)==0)
{
$last_id=array(0);
}
else
{
$last_id=mysqli_fetch_array($last_id,MYSQLI_NUM);
}

//THE NEXT RECORD WILL BE LAST RECORD + 1
$last_id=$last_id[0] + 1;

//CREATE A RANDOM KEY
$tie=mt_rand(1000000,2000000).$last_id;

//INSERT THE CONTACT INTO THE DB
$result=mysqli_query($dbc,"INSERT into cms(id,fullname,phone,email,company,jobtitle,website,address,date_entered,created_by,fk_tenant_id,fk_tenant_token) values($tie,'$fullname','$phone','$email','$company','$jobtitle','$website','$address',NOW(),'$created_by',$tenant_id,'$tenant_token')");

if(mysqli_affected_rows($dbc)==1)//IF THE INSERT WAS SUCCESSFULL
{
$_POST=array();
$success[]='Successful.&nbsp;<a href="contacts.php" class="whitestrong">Go to contacts</a>';
}
else{
$error[]= 'Contact NOT added';
//echo mysqli_error($dbc);
}
}// CLOSE IF EMPTY ERROR
}// CLOSE IF ISSET POST SUBMIT


//IF THE CANCEL BUTTON IS CLICKED, CLEAR THE FORM
if(isset($_POST['cancel']))
{
$_POST=array();
}
include('includes/alert.php');
?>
</div></div>
<div class="row">
<div class="large-12 columns">
<div class="medium-6 large-6 columns">
<form action="" method="POST">
<div id="namesection">
<h5>Name</h5>
<input type="text" name="fullname" placeholder="Add a name" size="50" maxlength="50"
value="<?php if(isset($_POST['fullname'])){ echo $_POST['fullname'];} ?>" />
</div>
<div id="phonesection">
<h5>Phone</h5>
<p><input type="text" placeholder="Add a phone number" id="phone" name="phone"  size="50" maxlength="20" value="<?php if(isset($_POST['phone'])) {echo $phone;} ?>" /></p>
</div>
<div id="emailsection">
<h5>Email</h5>
<p><input type="text" placeholder="Add an email" id="email" name="email"  size="50" maxlength="50" value="<?php if(isset($_POST['email'])) {echo $email;}?>" /></p>
</div>
<div id="addresssection">
<h5>Address</h5>
<p ><input type="text" placeholder="Add an address" id="address" name="address"  value="<?php if(isset($_POST['address'])) { echo $address;} ?>" /></p>
</div>
</div>
<!--COLUMN 2-->
<div class="medium-6 large-6 columns">
<div id="companysection">
<h5>Company</h5>
<input type="text" placeholder="Add a Company" id="company" name="company"  size="50" maxlength="100" value="<?php if(isset($_POST['company'])) {echo $_POST['company'];} ?>" />
<h5>Job Title</h5>
<input type="text" placeholder="Add a Job Title" id="jobtitle" name="jobtitle"  size="50" maxlength="100" value="<?php if(isset($_POST['jobtitle'])) {echo $_POST['jobtitle'];} ?>" />
<h5>Website</h5>
<label> Please website should be in this format (http://yahoo.com) only. No www. </label>
<input type="text" placeholder="Add a Website" id="website" name="website"  size="50" maxlength="100" value="<?php if(isset($_POST['website'])){ echo $_POST['website'];} ?>" />
</div>

<div id="submitsection">
<input type="submit" name="submit" class="thin radius button" value="ADD" style="margin-left:0; width:30%" />
<input type="submit" name="cancel" class="thin radius button" value="CANCEL" style="margin-left:7px; width:30%"; />
</form>
</div>
</div>
</div>
</div>

<?php include('includes/footer.html');?>

