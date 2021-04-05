$(document).ready(function (){
    $('#pass, #re_pass').on('keyup', function () {   
        if ($('#pass').val() == '' && $('#re_pass').val() =='') {
            $('#re_pass').css('border-color', '#999');  
        }  
        else if ($('#pass').val() == $('#re_pass').val() && $('#pass').val() != '') {         			 
            $('#re_pass').css('border-color', 'lime');   
        } 
        else {
            $('#re_pass').css('border-color', 'red'); 
        }
    });
})

function checkPassword() { 
    if (document.getElementById('pass').value != document.getElementById('re_pass').value) { 
        alert ("Passwords did not match") 
        return false; 
    } 
    else { 
        //alert("Your member record was created!\nWelcome :)") 
        return true; 
    } 
}
