<?php

function sanitize($x){

  if(!empty($x))
  {
  if(is_array($x))
  {
  foreach($x as $value)
  {
  $x=stripslashes(htmlentities(trim(strip_tags($value))));
  $x=str_replace(array('[', ']', '"','*','=','<','>','‘','’','%',"\\"), '', json_encode($x));  
  }
  }
  else
  {
  $x=stripslashes(htmlentities(trim(strip_tags($x))));
  $x=str_replace(array('[', ']', '"','*','=','<','>','‘','’','%',"\\"), '', json_encode($x));
  }
  }
 return $x;
  }


?>