"use strict"

$(document).ready( () => {
$('#username').focus();
let isValid;
let umsg = "";
let pmsg = "";

// Check if username is limited to numbers and letters and length of 3-10 characters
function validateUsername() {
    umsg = "";
        let username = $('#username').val().trim();
        var userReg = new RegExp('^[A-Za-z][A-Za-z0-9_]{2,11}$');
        
        if (username == "" || !(userReg.test(username))){
        umsg = 'You must enter a valid username.';
		isValid = false;
		}
}

// Check if password is empty
function validatePassword() {
    pmsg = "";
    let password = $('#password').val().trim();

    if (password == ""){
        pmsg = 'You must enter a valid password.';
		isValid = false;
    }
}

/*
    // Check if password is valid when user navigates out of input
    $("#username").bind('blur', function(event) {
        validateUsername();
        $("#errorMsg").text(umsg);
    } )

    // Check if password is entered when user navigates out of input
    $("#password").bind('blur', function(event) {
        validatePassword();
        $("#errorMsg").text(pmsg);
    } )
	*/

    // Check if both input fields are valid and output any corresponding errors
    $('#form_login').submit( event => {
		isValid = true;
        validateUsername();
        validatePassword();
		

		if (isValid == false)
		{
			if (umsg != "" && pmsg != ""){
				$("#errorMsg").html(umsg + "<br>" + pmsg);
			} else if (umsg != "") {
				$("#errorMsg").html(umsg);
			} else {
				$("#errorMsg").html(pmsg);
			}
				
            event.preventDefault();
        }
		
		
    })


});
