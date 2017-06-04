function validateForm() {
    var uName = document.forms["regForm"]["user"].value;
    if (uName == "") {
        alert("UserName must be filled out");
        return false;
    }
    var x = document.forms["regForm"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
    
    var pword = document.forms["regForm"]["pword"].value;
    var pword_ver = document.forms["regForm"]["verify"].value;
    
    if(pword !== pword_ver)
    {
        alert("Passwords do not match");
        return false;
    }
    
    $(".bio").text("<b>this text will be displayed, even the b tag.");
}