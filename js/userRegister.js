function check(){
    var username= document.getElementById("Username").value.trim();            
    const regExpUser= /^[a-zA-Z0-9_\.]{3,20}$/;

    var email= document.getElementsByName("Email")[0].value;
    var regExpEmail=/^[a-zA-Z]+[a-zA-Z0-9_!#$%&]{2,}@[a-zA-Z]+\.[a-zA-Z]{2,}/;

    var createpass= document.getElementById("CreatePassword").value.trim();
    var confirmpass= document.getElementById("ConfirmPassword").value.trim();
    
    // Reset error messages initially
    document.getElementById("usernameErr").style.display = "none";
    document.getElementById("emailErr").style.display = "none";
    document.getElementById("createPassErr").style.display = "none";
    document.getElementById("confirmPassErr").style.display = "none";

    if(!regExpUser.test(username)){
        document.getElementById("usernameErr").innerHTML="!!!Please Enter valid alphanumeric Username(_ and . are allowed)!";
        document.getElementById("usernameErr").style.display = "block";  // Show error
        return false;
    }
    else if(!regExpEmail.test(email)){
        document.getElementById("emailErr").innerHTML="!!!Invalid email!!!";
        document.getElementById("emailErr").style.display = "block";  // Show error
        return false;
    }
    else if(createpass.length<8){
        document.getElementById("createPassErr").innerHTML="!!!Password is too short!!!";
        document.getElementById("createPassErr").style.display = "block";  // Show error
        return false;
    }
    else if(confirmpass===""){
        document.getElementById("confirmPassErr").innerHTML="!!!Please Enter to confirm password!!!";
        document.getElementById("confirmPassErr").style.display = "block";  // Show error
        return false;
    }
    else if(confirmpass!==createpass){
        document.getElementById("confirmPassErr").innerHTML="!!!Create Password and Confirm Password do not match.!!!";
        document.getElementById("confirmPassErr").style.display = "block";  // Show error
        return false;
    }
    else{
        return true;
    }
}
