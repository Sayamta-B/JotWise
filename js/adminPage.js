function validate(){
    var Episodes= document.getElementById("Episodes").value.trim();
    var Duration= document.getElementById("R_Price").value.trim();

    if(Episodes<0){
        alert("Episodes cannot be in negative");
        return false;
    }
    else if(Duration<0){
        alert("Duration cannot be in negative");
        return false;
    }
    else if(Rate<0){
        alert("Rate cannot be in negative");
        return false;
    }
    else if(Rate>10){
        alert("Please rate out of 10.");
        return false;
    }
    else{
        return true;
    }
}
