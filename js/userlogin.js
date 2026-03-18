function checkEmpty(){
    var username=document.getElementsByName("V_UserNameOremail")[0].value;
    var password=document.getElementsByName("V_Password")[0].value;

    //Reset Error Message
    document.getElementById("V_identifierErr").style.display = "none";
    document.getElementById("V_passwordErr").style.display = "none";

    if(username===""){
        document.getElementById("V_identifierErr").innerHTML="!!!Please Enter Username!!!";
        document.getElementById("V_identifierErr").style.display = "block";  // Show error
        return false;
    }
    else if(password===""){
        document.getElementById("V_passwordErr").innerHTML="!!!Please Enter password!!!";
        document.getElementById("V_passwordErr").style.display = "block";  // Show error
        return false;
    }
    else{
        return true;
    }
}
