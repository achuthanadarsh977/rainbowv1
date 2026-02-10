

//CHECK/UNCHECK ALL CHECKBOXES
function Check(chk)
{
var chk = new Array(); 
chk = document.getElementsByName('checkbox[]');
if(document.checkboxesform.checkboxall.checked==true){
for (i = 0; i < chk.length; i++)
chk[i].checked = true ;
}else{

for (i = 0; i < chk.length; i++)
chk[i].checked = false ;
}
}

//CONFIRM DELETE

    function confirmdelete(){


    var del=confirm("Are you sure you want to delete this record(s)?");

    if(del==false)
    {
        alert("Record(s) Not Deleted");
    }
    return del;
    }


       