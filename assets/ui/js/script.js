$(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker" ).datepicker();
	//Pass the user selected date format 
    $( "#datepicker" ).datepicker( "option", "dateFormat",'yy-mm-dd');
	
	$( ".datepicker" ).datepicker();
	//Pass the user selected date format 
    $( ".datepicker" ).datepicker( "option", "dateFormat",'yy-mm-dd');
  });
  
});
