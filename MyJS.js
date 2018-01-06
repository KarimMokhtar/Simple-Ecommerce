$(function() {
	'use strict';
	$('input').each(function(){
		if($(this).attr('required') === 'required'){
			$(this).after('<span class="negma">*required</span>');
		}
	});
});
function check_Sign_Up() {
    var x = document.forms["frm1"];
    var text = true;
    var i;
    for (i = 0; i < x.length-1 ;i++) { // -1 for the submit button we don't need check it
        if(!x.elements[i].value){
        	if(i == 0) document.getElementById("one").innerHTML = 'User Name:<div class = "alert alert-danger">Sorry you must enter a <strong>user name</strong></div>';
        	if(i == 1) document.getElementById("two").innerHTML = 'Password:<div class = "alert alert-danger">Sorry you must enter a <strong>password</strong></div>';
        	if(i == 2) document.getElementById("three").innerHTML = 'Name:<div class = "alert alert-danger">Sorry you must enter a <strong>Name</strong></div>';
        	if(i == 3) document.getElementById("four").innerHTML = 'Email:<div class = "alert alert-danger">Sorry you must enter an <strong>Email</strong></div>';
            text = false;
        }
        // check if email isn't in the valid form
        else if(i == 3){
        	var test = x.elements[i].value;
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        	if(!re.test(test)){//test.indexOf("@") < 0 || test.indexOf(".") < 0
        	   document.getElementById("four").innerHTML = 'Email:<div class = "alert alert-danger">Write an available Email<strong>Email</strong></div>';
        	   text = false;
            }
        }
    }
    return text;
}
function selectFun(){
    var x = document.getElementsByClassName("Item");
    var ITEMS = [];
    for(var i = 0 ; i < x.length ; ++i){
        if(x[i].checked == true)ITEMS.push(x[i].value);
    }

    window.location='Selected.php?ITEMS[]='+ITEMS;
   
   
}
